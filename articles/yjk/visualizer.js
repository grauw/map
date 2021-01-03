import { Vector4, clamp } from "./vector.js";

export class Visualizer {
	constructor(container) {
		this.jkCanvas = container.querySelector("canvas.jk");
		this.yCanvas = container.querySelector("canvas.y");
		this.yInput = container.querySelector("input.y");
		this.jInput = container.querySelector("input.j");
		this.kInput = container.querySelector("input.k");
		this.rInput = container.querySelector("input.r");
		this.gInput = container.querySelector("input.g");
		this.bInput = container.querySelector("input.b");
		this.rangeCheckbox = container.querySelector("input.range");
		this.yaeCheckbox = container.querySelector("input.yae");
		this.editingInput = null;
		this.yjk = new Vector4(16, 0, 0, 31);
		this.gamma = 1.1;
		this.clipRange = this.rangeCheckbox.checked;
		this.yStep = this.yaeCheckbox.checked ? 2 : 1;

		this.setYJK(this.getYJKInput());
		this.update();

		addSlideListener(this.jkCanvas, this.onJKCanvasClick.bind(this));
		addSlideListener(this.yCanvas, this.onYCanvasClick.bind(this));
		addArrowKeyListener(this.jkCanvas, this.onJKCanvasArrowKey.bind(this));
		addArrowKeyListener(this.yCanvas, this.onYCanvasArrowKey.bind(this));
		addNumberInputListener(this.yInput, this.onYJKInputChange.bind(this));
		addNumberInputListener(this.jInput, this.onYJKInputChange.bind(this));
		addNumberInputListener(this.kInput, this.onYJKInputChange.bind(this));
		addNumberInputListener(this.rInput, this.onRGBInputChange.bind(this));
		addNumberInputListener(this.gInput, this.onRGBInputChange.bind(this));
		addNumberInputListener(this.bInput, this.onRGBInputChange.bind(this));
		this.rangeCheckbox.addEventListener("change", this.onRangeCheckboxChange.bind(this));
		this.yaeCheckbox.addEventListener("change", this.onYAECheckboxChange.bind(this));
	}

	setYJK(yjk) {
		this.yjk = new Vector4(yjk.x & -this.yStep, yjk.y, yjk.z, yjk.w);
	}

	getYJKInput() {
		return new Vector4(
			clamp(Math.round(this.yInput.value), 0, 31),
			clamp(Math.round(this.jInput.value), -32, 31),
			clamp(Math.round(this.kInput.value), -32, 31),
			31
		);
	}

	getRGBInput() {
		return new Vector4(
			clamp(Math.round(this.rInput.value), 0, 31),
			clamp(Math.round(this.gInput.value), 0, 31),
			clamp(Math.round(this.bInput.value), 0, 31),
			31
		);
	}

	onJKCanvasClick(event) {
		this.setYJK(new Vector4(
			this.yjk.x,
			clamp(Math.floor(event.offsetX * 64 / this.jkCanvas.width - 32), -32, 31),
			clamp(Math.floor(event.offsetY * 64 / this.jkCanvas.height - 32), -32, 31),
			this.yjk.w
		));
		this.update();
	}

	onYCanvasClick(event) {
		this.setYJK(new Vector4(
			clamp(Math.floor(event.offsetY * 32 / this.yStep / this.yCanvas.height) * this.yStep, 0, 31),
			this.yjk.y,
			this.yjk.z,
			this.yjk.w
		));
		this.update();
	}

	onJKCanvasArrowKey(x, y) {
		this.setYJK(new Vector4(this.yjk.x, clamp(this.yjk.y + x, -32, 31), clamp(this.yjk.z + y, -32, 31), this.yjk.w));
		this.update();
	}

	onYCanvasArrowKey(x, y) {
		this.setYJK(new Vector4(clamp(this.yjk.x + y * this.yStep, 0, 31), this.yjk.y, this.yjk.z, this.yjk.w));
		this.update();
	}

	onYJKInputChange(event) {
		this.editingInput = event.type == "input" ? event.target : null;
		this.setYJK(this.getYJKInput());
		this.update();
	}

	onRGBInputChange(event) {
		this.editingInput = event.type == "input" ? event.target : null;
		this.setYJK(this.getRGBInput().toYJK());
		this.update();
	}

	onRangeCheckboxChange(event) {
		this.clipRange = this.rangeCheckbox.checked;
		this.update();
	}

	onYAECheckboxChange(event) {
		this.yStep = this.yaeCheckbox.checked ? 2 : 1;
		this.setYJK(this.yjk);
		this.update();
	}

	update() {
		this.updateJKCanvas();
		this.updateYCanvas();
		this.updateInputs();
	}

	updateJKCanvas() {
		const width = this.jkCanvas.width / 64;
		const height = this.jkCanvas.height / 64;
		const context = this.jkCanvas.getContext("2d");
		context.clearRect(0, 0, this.jkCanvas.width, this.jkCanvas.height);
		for (let k = -32; k < 32; ++k) {
			for (let j = -32; j < 32; ++j) {
				const rgb = new Vector4(this.yjk.x, j, k, this.yjk.w).toRGB();
				const a = this.clipRange && !rgb.isInRange() ? 0.5 : 1;
				const rgb24 = rgb.saturate().power(Vector4.scalar(this.gamma)).project(255);
				context.fillStyle = `rgba(${rgb24.x}, ${rgb24.y}, ${rgb24.z}, ${a})`;
				context.fillRect((j + 32) * width, (k + 32) * height, width, height);
			}
		}
		context.lineWidth = 2;
		context.strokeStyle = "rgb(255, 255, 255)"
		context.strokeRect((this.yjk.y + 32) * width, (this.yjk.z + 32) * height, width, height);
	}

	updateYCanvas() {
		const width = this.yCanvas.width;
		const height = this.yCanvas.height / 32;
		const context = this.yCanvas.getContext("2d");
		context.clearRect(0, 0, this.yCanvas.width, this.yCanvas.height);
		for (let y = 0; y < 32; y += this.yStep) {
			const rgb = new Vector4(y, this.yjk.y, this.yjk.z, this.yjk.w).toRGB();
			const a = this.clipRange && !rgb.isInRange() ? 0.5 : 1;
			const rgb24 = rgb.saturate().power(Vector4.scalar(this.gamma)).project(255);
			context.fillStyle = `rgba(${rgb24.x}, ${rgb24.y}, ${rgb24.z}, ${a})`;
			context.fillRect(0, y * height, width, this.yStep * height);
		}
		context.lineWidth = 2;
		context.strokeStyle = "rgb(255, 255, 255)"
		context.strokeRect(1, this.yjk.x * height, width - 2, this.yStep * height);
	}

	updateInputs() {
		this.yInput.step = this.yStep;
		if (this.yInput != this.editingInput)
			this.yInput.value = this.yjk.x;
		if (this.jInput != this.editingInput)
			this.jInput.value = this.yjk.y;
		if (this.kInput != this.editingInput)
			this.kInput.value = this.yjk.z;
		if (this.rInput != this.editingInput)
			this.rInput.value = this.yjk.toRGB().x;
		if (this.gInput != this.editingInput)
			this.gInput.value = this.yjk.toRGB().y;
		if (this.bInput != this.editingInput)
			this.bInput.value = this.yjk.toRGB().z;
	}
}

function addSlideListener(element, listener) {
	element.addEventListener("pointerdown", event => {
		element.setPointerCapture(event.pointerId);
		element.addEventListener("pointermove", listener);
		listener(event);
	});
	element.addEventListener("pointerup", event => {
		element.releasePointerCapture(event.pointerId);
		element.removeEventListener("pointermove", listener);
		listener(event);
	});
	element.addEventListener("pointercancel", event => {
		element.releasePointerCapture(event.pointerId);
		element.removeEventListener("pointermove", listener);
	});
}

function addArrowKeyListener(element, listener) {
	element.tabIndex = 0;
	element.addEventListener("keydown", event => {
		const x = event.code == "ArrowLeft" ? -1 : event.code == "ArrowRight" ? 1 : 0;
		const y = event.code == "ArrowUp" ? -1 : event.code == "ArrowDown" ? 1 : 0;
		if (x || y) {
			listener(x, y);
			event.preventDefault();
		}
	});
}

function addNumberInputListener(element, listener) {
	element.addEventListener("change", listener);
	element.addEventListener("input", event => {
		if (element.value && !isNaN(element.value))
			listener(event);
	});
}
