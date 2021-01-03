export function clamp(value, min, max) {
	return Math.min(Math.max(value, min), max);
}

export class Vector4 {
	constructor(x, y, z, w) {
		this.x = x;
		this.y = y;
		this.z = z;
		this.w = w;
	}

	static scalar(value) {
		return new Vector4(value, value, value, value);
	}

	transform(matrix) {
		return matrix.multiplyVector(this);
	}

	add(other) {
		return new Vector4(this.x + other.x, this.y + other.y, this.z + other.z, this.w + other.w);
	}

	addw(other) {
		return new Vector4(this.x * other.w + other.x, this.y * other.w + other.y, this.z * other.w + other.z, this.w * other.w);
	}

	subtract(other) {
		return new Vector4(this.x - other.x, this.y - other.y, this.z - other.z, this.w - other.w);
	}

	multiply(other) {
		return new Vector4(this.x * other.x, this.y * other.y, this.z * other.z, this.w * other.w);
	}

	average(other) {
		return new Vector4(
			this.x * other.w + other.x * this.w,
			this.y * other.w + other.y * this.w,
			this.z * other.w + other.z * this.w,
			this.w * other.w + other.w * this.w
		);
	}

	dot(other) {
		return this.x * other.x + this.y * other.y + this.z * other.z + this.w * other.w;
	}

	cross(other) {
		if (this.w || other.w)
			throw new Error("Cross product must use a 3D vector.");
		return new Vector4(this.y * other.z - this.z * other.y, this.z * other.x - this.x * other.z, this.x * other.y - this.y * other.x, 0);
	}

	magnitude() {
		return Math.sqrt(this.magnitudeSquared());
	}

	magnitudeSquared() {
		return this.dot(this);
	}

	normalize() {
		return this.multiply(Vector4.scalar(1 / this.magnitude()));
	}

	isZero(threshold) {
		return this.magnitudeSquared() <= (threshold || 0);
	}

	power(exponent) {
		return new Vector4(Math.pow(this.x, exponent.x), Math.pow(this.y, exponent.y), Math.pow(this.z, exponent.z), Math.pow(this.w, exponent.w))
	}

	project(scale) {
		return new Vector4(this.x * scale / this.w, this.y * scale / this.w, this.z * scale / this.w, scale);
	}

	min(other) {
		return new Vector4(Math.min(this.x, other.x), Math.min(this.y, other.y), Math.min(this.z, other.z), Math.min(this.w, other.w))
	}

	max(other) {
		return new Vector4(Math.max(this.x, other.x), Math.max(this.y, other.y), Math.max(this.z, other.z), Math.max(this.w, other.w))
	}

	clamp(min, max) {
		return min.max(max.min(this));
	}

	saturate() {
		return new Vector4(clamp(this.x, 0, this.w), clamp(this.y, 0, this.w), clamp(this.z, 0, this.w), this.w);
	}

	floor() {
		return new Vector4(Math.floor(this.x), Math.floor(this.y), Math.floor(this.z), Math.floor(this.w));
	}

	ceil() {
		return new Vector4(Math.ceil(this.x), Math.ceil(this.y), Math.ceil(this.z), Math.ceil(this.w));
	}

	round() {
		return new Vector4(Math.round(this.x), Math.round(this.y), Math.round(this.z), Math.round(this.w));
	}

	equals(other) {
		return this.x * other.w == other.x * this.w && this.y * other.w == other.y * this.w && this.z * other.w == other.z * this.w;
	}

	almostEquals(other) {
		return Math.abs(this.x * other.w - other.x * this.w) < 0.01 &&
			Math.abs(this.y * other.w - other.y * this.w) < 0.01 &&
			Math.abs(this.z * other.w - other.z * this.w) < 0.01;
	}

	isInRange() {
		return this.x >= 0 && this.x <= this.w && this.y >= 0 && this.y <= this.w && this.z >= 0 && this.z <= this.w;
	}

	isInInnerRange() {
		return this.x > 0 && this.x < this.w && this.y > 0 && this.y < this.w && this.z > 0 && this.z < this.w;
	}

	toRGB() {
		return new Vector4(this.x + this.y, this.x + this.z, Math.floor(1.25 * this.x + -0.5 * this.y + -0.25 * this.z), this.w);
	}

	toYJK() {
		const y = Math.ceil(0.25 * this.x + 0.125 * this.y + 0.5 * this.z);
		return new Vector4(y, this.x - y, this.y - y, this.w);
	}

	toYJKYAE() {
		const y = 2 * Math.ceil((0.25 * this.x + 0.125 * this.y + 0.5 * this.z) / 2);
		return new Vector4(y, this.x - y, this.y - y, this.w);
	}

	toString() {
		return `(${this.x}, ${this.y}, ${this.z}, ${this.w})`;
	}

	toFloat32Array() {
		return Vector4.toFloat32Array(this);
	}

	static toFloat32Array(...vectors) {
		const array = new Float32Array(vectors.length * 4);
		Vector4.copyToArray(array, ...vectors);
		return array;
	}

	static copyToArray(array, ...vectors) {
		for (let i = 0; i < vectors.length; i++)
			vectors[i].copyToArray(array, i * 4);
	}

	copyToArray(array, offset) {
		array[offset + 0] = this.x;
		array[offset + 1] = this.y;
		array[offset + 2] = this.z;
		array[offset + 3] = this.w;
	}
}
