const button = document.querySelector("#submitToCart");
const sphere1 = document.querySelector("#sphere1");
const sphere2 = document.querySelector("#sphere2");

button.addEventListener("mouseover", () => {
	//The First Sphere
	sphere1.style.left = "30%";
	sphere1.style.top = "40%";
	sphere1.style.opacity = "1";

	//The Second Sphere
	sphere2.style.left = "14%";
	sphere2.style.top = "45%";
	sphere2.style.opacity = "1";
});

button.addEventListener("mouseleave", () => {
	for(let sphere of [sphere1, sphere2]){
		sphere.style.left = "22.5%";
		sphere.style.top = "43%";
		sphere.style.opacity = "0";
	}
});
