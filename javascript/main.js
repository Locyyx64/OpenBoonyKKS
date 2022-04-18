const inputs = document.querySelectorAll("input");

const openPage = async () => {
	await Promise.all([change("#userInput", "width", "30vw", 100, 1.5), change("#userInput", "left", "50%", 100, 1.5)]);
	await change("form", "width", "100%", 100, 1.5);
	await change('#submit-btn', "width", "10rem !important", 500, 1.5);
	for (let input of inputs) {
		input.style.width = "20rem";
		input.style.transition = "width 1.5s ease-in-out";
	}
};

openPage();
