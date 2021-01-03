import { Vector4 } from "./vector.js";

export class Matrix4x4 {
	constructor(row0, row1, row2, row3) {
		this.row0 = row0;
		this.row1 = row1;
		this.row2 = row2;
		this.row3 = row3;
	}

	static identity() {
		return Matrix4x4.scale(Vector4.scalar(1));
	}

	static scale(vector) {
		return new Matrix4x4(
			new Vector4(vector.x, 0, 0, 0),
			new Vector4(0, vector.y, 0, 0),
			new Vector4(0, 0, vector.z, 0),
			new Vector4(0, 0, 0, vector.w)
		);
	}

	static translate(vector) {
		return new Matrix4x4(
			new Vector4(1, 0, 0, vector.x),
			new Vector4(0, 1, 0, vector.y),
			new Vector4(0, 0, 1, vector.z),
			new Vector4(0, 0, 0, vector.w)
		);
	}

	static rotateX(angle) {
		return new Matrix4x4(
			new Vector4(1, 0, 0, 0),
			new Vector4(0, Math.cos(angle), -Math.sin(angle), 0),
			new Vector4(0, Math.sin(angle), Math.cos(angle), 0),
			new Vector4(0, 0, 0, 1)
		);
	}

	static rotateY(angle) {
		return new Matrix4x4(
			new Vector4(Math.cos(angle), 0, -Math.sin(angle), 0),
			new Vector4(0, 1, 0, 0),
			new Vector4(Math.sin(angle), 0, Math.cos(angle), 0),
			new Vector4(0, 0, 0, 1)
		);
	}

	static rotateZ(angle) {
		return new Matrix4x4(
			new Vector4(Math.cos(angle), -Math.sin(angle), 0, 0),
			new Vector4(Math.sin(angle), Math.cos(angle), 0, 0),
			new Vector4(0, 0, 1, 0),
			new Vector4(0, 0, 0, 1)
		);
	}

	static rotateXYZ(vector) {
		vector = vector.project(2 * Math.PI);
		return Matrix4x4.rotateX(vector.x).multiply(Matrix4x4.rotateY(vector.y)).multiply(Matrix4x4.rotateZ(vector.z));
	}

	static orthogonal(width, height, depth, near) {
		const far = near + depth;
		return new Matrix4x4(
			new Vector4(2 / width, 0, 0, 0),
			new Vector4(0, 2 / height, 0, 0),
			new Vector4(0, 0, -2 / depth, -(far + near) / depth),
			new Vector4(0, 0, 0, 1)
		);
	}

	static perspective(width, height, depth, near) {
		const far = near + depth;
		return new Matrix4x4(
			new Vector4(2 * near / width, 0, 0, 0),
			new Vector4(0, 2 * near / height, 0, 0),
			new Vector4(0, 0, -(far + near) / depth, -2 * far * near / depth),
			new Vector4(0, 0, -1, 0)
		);
	}

	multiplyVector(vector) {
		return new Vector4(this.row0.dot(vector), this.row1.dot(vector), this.row2.dot(vector), this.row3.dot(vector));
	}

	multiply(matrix) {
		const transposed = matrix.transpose();
		return new Matrix4x4(
			transposed.multiplyVector(this.row0),
			transposed.multiplyVector(this.row1),
			transposed.multiplyVector(this.row2),
			transposed.multiplyVector(this.row3)
		);
	}

	transpose() {
		return new Matrix4x4(
			new Vector4(this.row0.x, this.row1.x, this.row2.x, this.row3.x),
			new Vector4(this.row0.y, this.row1.y, this.row2.y, this.row3.y),
			new Vector4(this.row0.z, this.row1.z, this.row2.z, this.row3.z),
			new Vector4(this.row0.w, this.row1.w, this.row2.w, this.row3.w)
		);
	}

	project(scalar) {
		const factor = Vector4.scalar(scalar / this.row3.w);
		return new Matrix4x4(this.row0.multiply(factor), this.row1.multiply(factor), this.row2.multiply(factor), this.row3.multiply(factor));
	}

	toFloat32Array() {
		const array = new Float32Array(16);
		const matrix = this.transpose();
		matrix.row0.copyToArray(array, 0);
		matrix.row1.copyToArray(array, 4);
		matrix.row2.copyToArray(array, 8);
		matrix.row3.copyToArray(array, 12);
		return array;
	}

	toString() {
		return `({$this.row0}, {$this.row1}, {$this.row2}, {$this.row3})`;
	}
}
