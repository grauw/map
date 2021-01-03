import { Vector4 } from "./vector.js";
import { Matrix4x4 } from "./matrix.js";

export const yjkToRGB = new Matrix4x4(
	new Vector4(4, 4, 0, 0),
	new Vector4(4, 0, 4, 0),
	new Vector4(5, -2, -1, 0),
	new Vector4(0, 0, 0, 4)
);

export const rgbToYJK = new Matrix4x4(
	new Vector4(2, 1, 4, 0),
	new Vector4(6, -1, -4, 0),
	new Vector4(-2, 7, -4, 0),
	new Vector4(0, 0, 0, 8)
);

export const yjkYAEToRGB = new Matrix4x4(
	new Vector4(8, 4, 0, 0),
	new Vector4(8, 0, 4, 0),
	new Vector4(10, -2, -1, 0),
	new Vector4(0, 0, 0, 4)
);

export const rgbToYJKYAE = new Matrix4x4(
	new Vector4(1, 0.5, 2, 0),
	new Vector4(6, -1, -4, 0),
	new Vector4(-2, 7, -4, 0),
	new Vector4(0, 0, 0, 8)
);

export const yuvToRGB = new Matrix4x4(
	new Vector4(4, 4, 0, 0),
	new Vector4(5, -2, -1, 0),
	new Vector4(4, 0, 4, 0),
	new Vector4(0, 0, 0, 4)
);

export const rgbToYUV = new Matrix4x4(
	new Vector4(2, 4, 1, 0),
	new Vector4(6, -4, -1, 0),
	new Vector4(-2, -4, 7, 0),
	new Vector4(0, 0, 0, 8)
);

export const yuvYAEToRGB = new Matrix4x4(
	new Vector4(8, 4, 0, 0),
	new Vector4(10, -2, -1, 0),
	new Vector4(8, 0, 4, 0),
	new Vector4(0, 0, 0, 4)
);

export const rgbToYUVYAE = new Matrix4x4(
	new Vector4(1, 2, 0.5, 0),
	new Vector4(6, -4, -1, 0),
	new Vector4(-2, -4, 7, 0),
	new Vector4(0, 0, 0, 8)
);

export const yuvToRGB601 = new Matrix4x4(
	new Vector4(1, 0, 0.701 / 0.615, 0),
	new Vector4(1, -0.114 * 0.886 / 0.436 / 0.587, -0.299 * 0.701 / 0.615 / 0.587, 0),
	new Vector4(1, 0.886 / 0.436, 0, 0),
	new Vector4(0, 0, 0, 1)
);

export const rgbToYUV601 = new Matrix4x4(
	new Vector4(0.299, 0.587, 0.114, 0),
	new Vector4(-0.299 * 0.436 / 0.886, -0.587 * 0.436 / 0.886, 0.436, 0),
	new Vector4(0.615, -0.587 * 0.615 / 0.701, -0.114 * 0.615 / 0.701, 0),
	new Vector4(0, 0, 0, 1)
);

export class Image {
	constructor(width, height) {
		this.width = width;
		this.height = height;
	}

	getPixel(x, y) {
		throw new Error("Not implemented.");
	}

	map(fn) {
		const data = [];
		for (let y = 0; y < this.height; ++y)
			for (let x = 0; x < this.width; ++x)
				data.push(fn(this.getPixel(x, y), x, y));
		return new ImageData(this.width, this.height, data);
	}

	filter(filter) {
		const data = [];
		for (let y = 0; y < this.height; ++y) {
			for (let x = 0; x < this.width; ++x) {
				let value = new Vector4(0, 0, 0, 0);
				for (let i = 0; i < filter.kernel.length; ++i) {
					const ix = x + i - filter.center;
					if (ix >= 0 && ix < this.width)
						value = value.add(this.getPixel(ix, y).project(filter.kernel[i]));
				}
				data.push(value);
			}
		}
		return new ImageData(this.width, this.height, data);
	}

	subsampleChroma1(filter, toRGB) {
		const filteredImage = this.filter(filter);
		// const yjkToY601 = new Vector4(1.0285, 0.242, 0.5585, 0);
		const yjkToY601 = rgbToYUV601.multiply(toRGB).row0;
		const yjkLuma = yjk => yjk.dot(yjkToY601) / yjkToY601.x;
		return this.map((yjk, x, y) => {
			const yjkScaled = yjk.project(31);
			const sample = filteredImage.getPixel(x & ~3, y).project(31);
			return new Vector4(sample.x + yjkLuma(yjkScaled) - yjkLuma(sample), sample.y, sample.z, sample.w);
		});
	}

	subsampleChroma2(filter, toRGB) {
		const filteredImage = this.filter(filter);
		const yjkLuminance = yjk => yjk.transform(toRGB).saturate().power(Vector4.scalar(1)).dot(rgbToYUV601.row0);
		return this.map((yjk, x, y) => {
			const yjkScaled = yjk.project(31);
			const sample = filteredImage.getPixel(x & ~3, y).project(31);
			const targetLuminance = yjkLuminance(yjkScaled);
			let bestDistance = Infinity;
			let bestY = 0;
			for (let y = 0; y < 32; y++) {
				const candidate = new Vector4(y, sample.y, sample.z, sample.w);
				const distance = Math.abs(yjkLuminance(candidate) - targetLuminance);
				if (distance < bestDistance) {
					bestDistance = distance;
					bestY = y;
				}
			}
			return new Vector4(bestY, sample.y, sample.z, sample.w);
		});
	}
}

export class ImageData extends Image {
	constructor(width, height, data) {
		super(width, height);
		if (data.length != width * height)
			throw new Error("Incomplete data.");
		this.data = data;
	}

	getPixel(x, y) {
		return this.data[y * this.width + x];
	}
}

export class CanvasImage extends ImageData {
	constructor(canvas, x, y, width, height) {
		const imageData = canvas.getContext("2d").getImageData(x || 0, y || 0, width || canvas.width, height || canvas.height).data;
		const data = [];
		for (let i = 0; i < imageData.length; i += 4) {
			data.push(new Vector4(imageData[i], imageData[i + 1], imageData[i + 2], 255));
		}
		super(canvas.width, canvas.height, data);
	}
}

export class Filter {
	constructor(kernel, center) {
		if (center < 0 || center >= kernel.length)
			throw new Error("Center outside kernel range.");
		this.kernel = kernel;
		this.center = center;
	}

	normalize(w) {
		const sum = this.kernel.reduce((accu, current) => accu + current);
		return new Filter(this.kernel.map(value => value * w / sum), this.center);
	}
}

export class BoxFilter extends Filter {
	constructor(size, center) {
		super(new Array(size).fill(1), center || 0);
	}
}

export const identityFilter = new Filter([1], 0);
export const boxFilter = new BoxFilter(4, 0);
export const tentFilter = new Filter([1, 3, 4, 4, 5, 4, 4, 3, 1], 3);
