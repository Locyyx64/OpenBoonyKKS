const profileImg = document.querySelector("#profileImg");
const dropdown = document.querySelector("#profileDropdown");

async function openPage(on){
	if (on === "on"){
		await Promise.all([change("#profileDropdown ul", "opacity", "1", 50), change("#profileDropdown", "height", "26%", 50)]);
	} else if (on === "off"){
		await Promise.all([change("#profileDropdown ul", "opacity", "0", 50), change("#profileDropdown", "height", "0%", 50)]);
	}
	else{
		console.log("Invalid option.");
	}
};


profileImg.addEventListener("mouseenter", () => {
	        openPage("on");
});
profileImg.addEventListener("mouseleave", () => {
	        openPage("off");
});
dropdown.addEventListener("mouseenter", () => {
	        openPage("on");
});
dropdown.addEventListener("mouseleave", () => {
	        openPage("off");
});
