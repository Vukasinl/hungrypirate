var controller, Player, Animation, Interactable, interval, loop, game;
var stats;


game = {
	end : false,
	hunger : 100,
	money : 0,
	score : 0,
	roomColor : "green",
	heroName : "",
	count : 0,
	hngId : document.getElementById("food"),
	scrId : document.getElementById("score"),
	mnyId : document.getElementById("gold"),
	backgroundId : document.getElementById("background"),
	fridgeSlots : [
		document.querySelector('#storage0'),
		document.querySelector('#storage1'),
		document.querySelector('#storage2'),
		document.querySelector('#storage3'),
		document.querySelector('#storage4'),
		document.querySelector('#storage5')
	],
	fridgeItems : ["","","","","",""],
	loadFridgeItems : function(){
		for(let i = 0; i < this.fridgeItems.length; i++){
			switch(stats.fridge[i]){
				case "e":
					this.fridgeItems[i] = "";
					break;
				case "a":
					this.fridgeItems[i] = "apple";
					break;
				case "s":
					this.fridgeItems[i] = "sandwich";
					break;
				case "b":
					this.fridgeItems[i] = "burger";
					break;
				case "p":
					this.fridgeItems[i] = "pizza";
					break;

			}
		}
	},
	saveFridgeItems : function(){
		for(let i = 0; i < this.fridgeItems.length; i++){
			switch(this.fridgeItems[i]){
				case "":
					stats.fridge = stats.fridge.substr(0, i) + "e" + stats.fridge.substr(i + 1);
					break;
				case "apple":
					stats.fridge = stats.fridge.substr(0, i) + "a" + stats.fridge.substr(i + 1);
					break;
				case "sandwich":
					stats.fridge = stats.fridge.substr(0, i) + "s" + stats.fridge.substr(i + 1);
					break;
				case "burger":
					stats.fridge = stats.fridge.substr(0, i) + "b" + stats.fridge.substr(i + 1);
					break;
				case "pizza":
					stats.fridge = stats.fridge.substr(0, i) + "p" + stats.fridge.substr(i + 1);
					break;
			}
		}
		console.log("fridgeItems: " + this.fridgeItems);
		console.log("fridge: " + stats.fridge);
	},
	foodWindow : {
		windowId : document.getElementById('fridge-window'),
		itemPrice : document.getElementById('item-info'),
		availableSlot : false,
		foodInfo : document.getElementById("storage-info-1"),
		scoreInfo : document.getElementById("storage-info-2"),
		inputs : [
			document.querySelector('#shop-01'),
			document.querySelector('#shop-02'),
			document.querySelector('#shop-03'),
			document.querySelector('#shop-04')
		],
		getFoodInfo : function(name) {
			let info = [];
			switch(name){
				case "":
					return info = [0, 0, 0];
					break;
				case "apple":
					return info = [100, 5, 10];
					break;
				case "sandwich":
					return info = [200, 10, 30];
					break;
				case "burger":
					return info = [300, 20, 40];
					break
				case "pizza":
					return info = [400, 30, 50];
					break;
			}
		},
		shop : function() {
			for(let i = 0; i < this.inputs.length; i++){
				if(this.inputs[i].checked){
					this.inputs[i].parentElement.style.backgroundColor = "rgba(48, 99, 68, 1)";
					this.itemPrice.innerHTML = this.getFoodInfo(this.inputs[i].value)[0];
				}
				else
					this.inputs[i].parentElement.style.backgroundColor = "rgba(48, 99, 68, .4)";
			}
			for(let i = 0; i < game.fridgeSlots.length; i++){
				if(game.fridgeSlots[i].firstElementChild.checked){
					game.fridgeSlots[i].style.backgroundColor = "rgba(48, 99, 68, 1)";
					this.foodInfo.innerHTML = "Hrana +" + this.getFoodInfo(game.fridgeItems[i])[2] + "%";
					this.scoreInfo.innerHTML = "Score +" + this.getFoodInfo(game.fridgeItems[i])[1];
				}
				else
					game.fridgeSlots[i].style.backgroundColor = "rgba(48, 99, 68, .4)";
			}
		},
		open : function(collision){
			if(collision && controller.e) {
				this.windowId.style.display = "block";
				this.load();
			}
		},
		load : function(){
			for (let i = 0; i < game.fridgeSlots.length; i++) {
				game.fridgeSlots[i].className = "storage-slot " + game.fridgeItems[i];
			}
		},
		close : function(){
			this.windowId.style.display = "none";
		},
		buy : function(){
			try{
				for (let i = 0; i < game.fridgeItems.length; i++) {
					if(game.fridgeItems[i] == ""){
						this.availableSlot = true;
						break;
					}else
						this.availableSlot = false;
				}
				if (this.availableSlot){
					if (game.money >= this.getFoodInfo(shop.shopradio.value)[0]) {
						game.money -= this.getFoodInfo(shop.shopradio.value)[0];
						game.foodWindow.store(shop.shopradio.value);
					}else
						throw "Nemate dovoljno para!";
				}else {
					throw "Nemate dovoljno mesta u frizideru!";
					}
				}catch(err){
					alert(err);
				}
			
		},
		store : function(item) {
				for (let i = 0; i < game.fridgeItems.length; i++) {
					if (game.fridgeItems[i] == ""){
						game.fridgeItems[i] = item;
						break;
					}
				}
			this.load();
		},
		eat : function() {
			for (var i = 0; i < game.fridgeSlots.length; i++) {
				if(game.fridgeSlots[i].firstElementChild.checked){
					game.hunger += this.getFoodInfo(game.fridgeItems[i])[2];
					game.score += this.getFoodInfo(game.fridgeItems[i])[1];
					game.fridgeItems[i] = "";
					if (game.hunger > 100)
						game.hunger = 100;
					break;
				}
			}
			this.load();
		}
	},
	start : function() {
		if (this.hunger <= 0) {
			document.querySelector(".endgame").style.display = "block";
			document.getElementById("finalscore").innerHTML = "SCORE :" + game.score;
			game.end = true;

		}
		if (this.count == 500) {
			this.hunger--;
			this.score++;
			this.money++;
			this.count = 0;
			game.saveGame();
		}
		this.hngId.innerHTML = this.hunger + "%";
		this.scrId.innerHTML = this.score;
		this.mnyId.innerHTML = this.money;
		this.count++;
	},
	work : function(collision) {
		if (collision && controller.e) {
			this.money++;
		}
	},
	saveGame : function() {
		this.saveFridgeItems();
		stats.food = game.hunger;
		stats.coins = game.money;
		stats.score = game.score;
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "scripts/php/savegame_scr.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onload = function () {
			if(this.status == 200){
				console.log("Igra je sačuvana!");
			}
		};
		xhr.send("food="+stats.food+"&coins="+stats.coins+"&score="+stats.score+"&fridge="+stats.fridge);
	},
	endGame : function() {
		this.saveFridgeItems();
		stats.food = game.hunger;
		stats.coins = game.money;
		stats.score = game.score;
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "scripts/php/endgame_scr.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onload = function () {
			if(this.status == 200){
				window.location.assign('index.php');
			}
		};
		xhr.send("food="+stats.food+"&coins="+stats.coins+"&score="+stats.score+"&fridge="+stats.fridge);
	}
};

var xmlhttp = new XMLHttpRequest();
xmlhttp.open("get", "scripts/php/get_data_scr.php", true);
xmlhttp.onload = function() {
	if (this.status==200){
		stats = JSON.parse(this.responseText);
		game.hunger = stats.food;
		game.money = stats.coins;
		game.score = stats.score;
		game.roomColor = stats.roomcolor;
		game.heroName = stats.heroname;
		game.loadFridgeItems();
		switch(game.roomColor){
			case "green":
				game.backgroundId.src = "assets/imgs/empty-room-green.jpg";
				break;
			case "blue":
				game.backgroundId.src = "assets/imgs/empty-room-blue.jpg";
				break;
			case "white":
				game.backgroundId.src = "assets/imgs/empty-room-white.jpg";
				break;
			case "yellow":
				game.backgroundId.src = "assets/imgs/empty-room-yellow.jpg";
				break;
			case "red":
				game.backgroundId.src = "assets/imgs/empty-room-red.jpg";
				break;
		}
	}
};
xmlhttp.send();

Player = function() {
	this.divId = document.querySelector("#player");
	this.imgId = document.getElementById("pimg");
	this.xVelocity = 0;
	this.yVelocity = 0;
	this.isJumping = false;
	this.status = "idle";
	this.animation = new Animation();
};
Player.prototype = {
	changeX : function(x) {this.divId.style.left = x + "px"},
	changeY : function(y) {this.divId.style.top = y + "px"},
	get x() { return this.divId.offsetLeft},
	get y() { return this.divId.offsetTop},
	changeStatus : function(newStatus){
		if (this.status != newStatus) {
			if (newStatus == "idle") {
				this.status = newStatus;
				this.imgId.style.background = 'url("assets/imgs/player.png") 0px 0px/960px 160px';
				this.imgId.style.imageRendering = "crisp-edges";
			}else if(newStatus == "walk"){
				this.status = newStatus;
				this.imgId.style.background = 'url("assets/imgs/playerwalk.png") 0px 0px/1920px 160px';
			}
		}
	}
};

Animation = function() {
	this.delay = 10;
	this.count = 0;
	this.stage = 1;
};

Animation.prototype = {
	animLoop : function(imgId){

		this.count ++;
		if (this.count == this.delay && this.stage == 1) {
			imgId.style.backgroundPosition = '0px 0px';
			this.count = 0;
			this.stage++;
		}
		else if (this.count == this.delay && this.stage == 2) {
			imgId.style.backgroundPosition = `-160px 0px`;
			this.count = 0;
			this.stage++;
		}
		else if (this.count == this.delay && this.stage == 3) {
			imgId.style.backgroundPosition = `-320px 0px`;
			this.count = 0;
			this.stage++;
		}
		else if (this.count == this.delay && this.stage == 4) {
			imgId.style.backgroundPosition = `-480px 0px`;
			this.count = 0;
			this.stage++;
		}
		else if (this.count == this.delay && this.stage == 5) {
			imgId.style.backgroundPosition = `-640px 0px`;
			this.count = 0;
			this.stage++;
		}
		else if (this.count == this.delay && this.stage == 6) {
			imgId.style.backgroundPosition = `-800px 0px`;
			this.count = 0;
			this.stage = 1;
		}
	}
};

Interactable = function(width, height, src) {
	this.id;
	this.width = width;
	this.height = height;
	this.src = src;
};

Interactable.prototype = {
	create : function(place, x, y){
		this.id = document.createElement("img");
		place.appendChild(this.id);
		this.id.src = this.src;
		this.id.style.position = "absolute";
		this.id.style.left = x + "px";
		this.id.style.top = y + "px";
		this.id.style.imageRendering = "crisp-edges";
		this.id.style.width = this.width + "px";
		this.id.style.height = this.height + "px";
	},
	get x() { return this.id.offsetLeft},
	get y() { return this.id.offsetTop},
	collision : function(player){
		if (player.x < this.x + this.width && player.x + 60> this.x ||
		 player.x + 160 > this.x && player.x + 160 < this.x + this.width)
			return true;
		else
			return false;
	}
};

controller = {
	up : false,
	left : false,
	right : false,
	e : false,
	keyListener: function(event) {
		let pressCheck;
		if (event.type == "keydown") {
			pressCheck = true;
		}else {pressCheck = false;}
		switch (event.keyCode){
			case 65:
				controller.left = pressCheck;
				break;
			case 87:
				controller.up = pressCheck;
				break;
			case 68:
				controller.right = pressCheck;
				break;
			case 69:
				controller.e = !pressCheck;
				break;

		}
	}
};	

document.getElementById("close-img").addEventListener('click', () => game.foodWindow.close());
document.getElementById("buy-btn").addEventListener('click', () => game.foodWindow.buy());
document.getElementById("eat-btn").addEventListener('click', () => game.foodWindow.eat());
plyr = new Player();

fridge = new Interactable(100, 200, "assets/imgs/fridge.png");
fridge.create(document.getElementById("game-window"), 150, 420);
computer = new Interactable(256, 200, "assets/imgs/computer.png");
computer.create(document.getElementById("game-window"), 900, 420);
loop = function() {
	game.start();
	plyr.changeX(plyr.x + plyr.xVelocity);
	plyr.changeY(plyr.y + plyr.yVelocity);
	plyr.xVelocity *= 0.9;
	plyr.yVelocity *= 0.9;
	plyr.yVelocity += 1.4;

	plyr.animation.animLoop(plyr.imgId);
	if(controller.left){
		plyr.xVelocity -= .7;
		plyr.changeStatus("walk");
	}
	if (controller.right) {
		plyr.xVelocity += .7;
		plyr.changeStatus("walk");
	}
	if (controller.up && plyr.isJumping == false) {
		plyr.yVelocity -= 35;
		plyr.isJumping = true;
		plyr.changeStatus("walk");
	}
	if (!controller.up && !controller.left && !controller.right){
		plyr.changeStatus("idle");
	}

	if (plyr.y > 500) {
		plyr.isJumping = false;
		plyr.yVelocity = 0;
		plyr.changeY(500);
	}

	if (plyr.x + 130 > 1200) {
		plyr.xVelocity = 0;
		plyr.changeX(1200 - 130);
	}

	if (plyr.x < -30){
		plyr.xVelocity = 0;
		plyr.changeX(-30);
	}
	if (fridge.collision(plyr)){
		fridge.id.style.opacity = .8;
	}
	else {
		fridge.id.style.opacity = 1;
	}
	if (computer.collision(plyr)){
		computer.id.style.opacity = .8;
	}
	else {
		computer.id.style.opacity = 1;
	}
	game.work(computer.collision(plyr));
	game.foodWindow.open(fridge.collision(plyr));
	game.foodWindow.shop();
	if (controller.e)
		controller.e = false;
	if(game.end)
		return;
	requestAnimationFrame(loop);
};

document.addEventListener("keyup", controller.keyListener);
document.addEventListener("keydown", controller.keyListener);
requestAnimationFrame(loop);