const all_names = {};
const search_drop = object => {
	const search_dropdown = document.querySelector("#searchDropdown");
	const input = document.querySelector("#searchInput");
	input.addEventListener("input", function (){
		clear_dropdown(search_dropdown);
		const curr_val = this.value.toLowerCase();
		const valid_names = {};
		setTimeout(() => {
			if(this.value){
				searchDropdown.innerHTML = "";
				console.log(curr_val);
				for(let name in object){
					if(name.toLowerCase().includes(curr_val)){
						valid_names[name] = object[name];
					}
				}
				append_items(valid_names, search_dropdown);
				console.log(valid_names);
				input.addEventListener("focus", () => {
					if(this.value){
						searchDropdown.innerHTML = "";
						append_items(valid_names, search_dropdown);
					}
				});
				input.addEventListener("blur", e => {
					try{
						if(e.relatedTarget.className !== "link"){
							clear_dropdown(search_dropdown);
						}
					} catch(err){
						clear_dropdown(search_dropdown);
					}
				});
			}
		}, 2000);
	});
};

const clear_dropdown = dropdown => {
	dropdown.innerHTML = "";
};

const append_items = (object, dropdown_list) => {
	for(let name in object){
        	const new_item = document.createElement("li");
		new_item.innerHTML = `<a href='products.php?prod_id=${object[name]}' class='link'><p><strong>${name}</strong></p></a>`;
		dropdown_list.append(new_item);
	}
};

