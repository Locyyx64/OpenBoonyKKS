const userInput = document.querySelector("#cryptoInput");
const cryptoList = document.querySelector("#cryptos ul");
const exitImg = "../images/static/exit.png";
let currCryptos = ["bitcoin", "ethereum", "solana"]

const getCryptos = () => {
	currCryptos.forEach((item, idx) => {
		const xhr = new XMLHttpRequest();
		xhr.addEventListener("load", () => {

			if(xhr.status !== 200){
				alert("Invalid currency!");
			}
			const data = JSON.parse(xhr.response);
			const cryptoEl = document.createElement("li");
			const exitEl = document.createElement("img");
			exitEl.src = exitImg;
			exitEl.id = `exit-img${idx-1}`;
			exitEl.classList.add("exit-img");
			cryptoEl.innerHTML = `${data.symbol.toUpperCase()} = <span id="price">$${data.tickers[0].last}</span> (<a href= 'https://www.coingecko.com/en/coins/${data.id}'>${data.name}</a>)`;
			cryptoEl.classList.add("crypto");
			cryptoEl.id = `crypto${idx+1}`;

			exitEl.addEventListener("click", () => {
				console.log(exitEl);
				currCryptos.splice(currCryptos.indexOf(data.id), 1)
				cryptoList.removeChild(cryptoEl);
			});
			cryptoEl.append(exitEl);
			cryptoList.append(cryptoEl);

			userInput.value = "";
		});
		xhr.addEventListener("error", () => {
			throw new Error("Something went wrong with the XHR.");
		});

		xhr.open("GET", `https://api.coingecko.com/api/v3/coins/${item}`);
		xhr.send();
	});
};
getCryptos();

userInput.addEventListener("keypress", e => {
	if(e.code === "Enter"){
		const xhr = new XMLHttpRequest();
		const input = userInput.value.split(" ").join("").toLowerCase();
		if (currCryptos.indexOf(input) !== -1) alert("Currency already added.");
		else{
			xhr.addEventListener("load", () => {

				if(xhr.status !== 200){
					alert("Invalid currency!");
				}
				const data = JSON.parse(xhr.response);
				const cryptoEl = document.createElement("li");
				const exitEl = document.createElement("img");
				exitEl.src = exitImg;
				exitEl.classList.add("exit-img");
				cryptoEl.innerHTML = `${data.symbol.toUpperCase()} = <span id='price'>$${data.tickers[0].last}</span> (<a href= 'https://www.coingecko.com/en/coins/${data.id}'>${data.name}</a>)`;
				cryptoEl.classList.add("crypto");
				currCryptos.push(data.id);


				exitEl.addEventListener("click", () => {
					currCryptos.splice(currCryptos.indexOf(data.id), 1);
					cryptoList.removeChild(cryptoEl);
				});
				cryptoEl.append(exitEl);
				cryptoList.append(cryptoEl);

				userInput.value = "";
			});
			xhr.addEventListener("error", () => {
				throw new Error("Something went wrong with the XHR.");
			});

			xhr.open("GET", `https://api.coingecko.com/api/v3/coins/${input}`);
			xhr.send();
		}
	}
});
