const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const timeDate = document.querySelector("#date");
const timeTime = document.querySelector("#time");

setInterval(() => {
	d = new Date();
	const days = d.getDate();
	const month = months[d.getMonth()];

	const hours = d.getHours() + 2;
	const minutes = d.getMinutes();
	const seconds = d.getSeconds();
	timeMessage = "";

	timeDate.innerText = `${month} ${days}, `;

	if(hours < 10){
		timeMessage += `0${hours}:`; 
	} else{
		timeMessage += `${hours}:`;
	}

	if(minutes < 10){
                timeMessage += `0${minutes}:`;
        } else{
                timeMessage += `${minutes}:`;
        }

	if(seconds < 10){
                timeMessage += `0${seconds}`;
        } else{
                timeMessage += `${seconds}`;
        }
	
	timeTime.innerText = timeMessage;
}, 1000);

