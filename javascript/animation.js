const change = (el, property, value, delay = 0, transition = 0) => {
	return new Promise((resolve, reject) => {
		if (!(el && property && value)) reject();
		else {
			setTimeout(() => {
				const element = document.querySelector(`${el}`);
				element.style[property] = `${value}`;
				if (transition) {
					if (element.style.transition){
						element.style.transition += `, ${property} ${transition}s ease-in.out`;
					} else{
						element.style.transition = `${property} ${transition}s ease-in-out`;
					}
				}
				resolve();
			}, delay);
		}
	});
};
