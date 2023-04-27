let turns = 1;

function init() {
    $(document).ready(function(){
        $("#00").click(function(){
            controller.processGuess("00");
        });
        $("#01").click(function(){
            controller.processGuess("01");
        });
        $("#02").click(function(){
            controller.processGuess("02");
        });
        $("#03").click(function(){
            controller.processGuess("03");
        });
        $("#04").click(function(){
            controller.processGuess("04");
        });
        $("#05").click(function(){
            controller.processGuess("05");
        });
        $("#06").click(function(){
            controller.processGuess("06");
        });
        $("#10").click(function(){
            controller.processGuess("10");
        });
        $("#11").click(function(){
            controller.processGuess("11");
        });
        $("#12").click(function(){
            controller.processGuess("12");
        });
        $("#13").click(function(){
            controller.processGuess("13");
        });
        $("#14").click(function(){
            controller.processGuess("14");
        });
        $("#15").click(function(){
            controller.processGuess("15");
        });
        $("#16").click(function(){
            controller.processGuess("16");
        });
        $("#20").click(function(){
            controller.processGuess("20");
        });
        $("#21").click(function(){
            controller.processGuess("21");
        });
        $("#22").click(function(){
            controller.processGuess("22");
        });
        $("#23").click(function(){
            controller.processGuess("23");
        });
        $("#24").click(function(){
            controller.processGuess("24");
        });
        $("#25").click(function(){
            controller.processGuess("25");
        });
        $("#26").click(function(){
            controller.processGuess("26");
        });
        $("#30").click(function(){
            controller.processGuess("30");
        });
        $("#31").click(function(){
            controller.processGuess("31");
        });
        $("#32").click(function(){
            controller.processGuess("32");
        });
        $("#33").click(function(){
            controller.processGuess("33");
        });
        $("#34").click(function(){
            controller.processGuess("34");
        });
        $("#35").click(function(){
            controller.processGuess("35");
        });
        $("#36").click(function(){
            controller.processGuess("36");
        });
        $("#40").click(function(){
            controller.processGuess("40");
        });
        $("#41").click(function(){
            controller.processGuess("41");
        });
        $("#42").click(function(){
            controller.processGuess("42");
        });
        $("#43").click(function(){
            controller.processGuess("43");
        });
        $("#44").click(function(){
            controller.processGuess("44");
        });
        $("#45").click(function(){
            controller.processGuess("45");
        });
        $("#46").click(function(){
            controller.processGuess("46");
        });
        $("#50").click(function(){
            controller.processGuess("50");
        });
        $("#51").click(function(){
            controller.processGuess("51");
        });
        $("#52").click(function(){
            controller.processGuess("52");
        });
        $("#53").click(function(){
            controller.processGuess("53");
        });
        $("#54").click(function(){
            controller.processGuess("54");
        });
        $("#55").click(function(){
            controller.processGuess("55");
        });
        $("#56").click(function(){
            controller.processGuess("56");
        });
        $("#60").click(function(){
            controller.processGuess("60");
        });
        $("#61").click(function(){
            controller.processGuess("61");
        });
        $("#62").click(function(){
            controller.processGuess("62");
        });
        $("#63").click(function(){
            controller.processGuess("63");
        });
        $("#64").click(function(){
            controller.processGuess("64");
        });
        $("#65").click(function(){
            controller.processGuess("65");
        });
        $("#66").click(function(){
            controller.processGuess("66");
        });
    });
    getSettings();
};

function openSettings() {
    document.getElementById("popup-settings").style.display = "block";
    document.getElementById("settings").style.display = "block";
};

function closeSettings(){
    document.getElementById("settings").style.display = "none";
    document.getElementById("popup-settings").style.display = "none";
};

function getSettings() {
    var numship = document.getElementById("num-ships");
    var numsets = document.getElementById("num-sets");
    model.numShips = parseInt(numship.value);
    model.limitSets = parseInt(numsets.value);
    var table = document.getElementsByTagName("table")[0];
    var tds = table.getElementsByTagName("td");

    for(var i = 0; i < tds.length; i++) {
        tds[i].classList.remove("hit", "miss", "special-hit");
    }
    model.sets = [0, 0];
    model.scores = [0, 0];
    model.ships = [];
    model.generateShipLocations();
    model.generateSpecialShipLocation();
    var winner = document.getElementById("winner");
    var scorep1 = document.getElementById("scorep1");
    var scorep2 = document.getElementById("scorep2");
    winner.innerHTML = "";
    scorep1.innerHTML = "Scores: " + String(model.scores[0]);
    scorep2.innerHTML = "Scores: " + String(model.scores[1]);
    var setp1 = document.getElementById("setp1");
    var setp2 = document.getElementById("setp2");
    setp1.innerHTML = model.sets[0];
    setp2.innerHTML = model.sets[1];
    
    document.getElementById("settings").style.display = "none";
    document.getElementById("popup-settings").style.display = "none";
};

function startGame(){
    var p1 = document.getElementById("userplayer1").value;
    var p2 = document.getElementById("userplayer2").value;
    model.player1 = p1;
    model.player2 = p2;
    var idp1 = document.getElementById("player1");
    var idp2 = document.getElementById("player2");
    var textp1 = idp1.getElementsByTagName("span");
    var textp2 = idp2.getElementsByTagName("span");
    textp1[0].innerHTML = p1;
    textp2[0].innerHTML = p2;
    document.getElementById("popup-start").style.display = "none";
    document.getElementById("start").style.display = "none";
};

function writeScore(){
    if (localStorage.getItem(model.player1) != null) {
        var play1 = JSON.parse(localStorage.getItem(model.player1));
        play1[0] += model.accumulatedScores[0];
        play1[1] += model.sets[0];
        localStorage.setItem(model.player1, JSON.stringify(play1));
    } else {
        var play1 = [model.accumulatedScores[0], model.sets[0]];
        localStorage.setItem(model.player1, JSON.stringify(play1));
    }
    if (localStorage.getItem(model.player2) != null) {
       var play2 = JSON.parse(localStorage.getItem(model.player2));
        play2[0] += model.accumulatedScores[1];
        play2[1] += model.sets[1];
        localStorage.setItem(model.player2, JSON.stringify(play2));
    } else {
        var play2 = [model.accumulatedScores[1], model.sets[1]];
        localStorage.setItem(model.player2, JSON.stringify(play2));
    }
};

function bubbleSort_mod(arr){
    for(let i = 0; i < arr.length; i++){
        for(let j = 0; j < arr.length - i - 1; j++){
            if(arr[j + 1][1] > arr[j][1]){
                [arr[j + 1],arr[j]] = [arr[j],arr[j + 1]]
            }else if(arr[j + 1][1] == arr[j][1]){
                if(arr[j + 1][2] > arr[j][2]){
                    [arr[j + 1],arr[j]] = [arr[j],arr[j + 1]]
                }
            }
        }
    }
    return arr;
};

function hofButton(){
    document.getElementById("popup-hof").style.display = "block";
    document.getElementById("hof").style.display = "block";
    var table = document.getElementById("hall-of-fame");
    var list = [];
    for (let i = 0; i < localStorage.length; i++) {
        var key = localStorage.key(i);
        var value = JSON.parse(localStorage.getItem(key));
        var data = [];
        data.push(key);
        data.push(value[0]);
        data.push(value[1]);
        list.push(data);
    }
    var list = bubbleSort_mod(list);
    // kayaknya perlu di sortir buat siapa yang punya score/set tertinggi
    for (let i = 0; i < list.length; i++) {
        var row = table.insertRow();
        var number = row.insertCell();
        var playerCell = row.insertCell();
        var scoreCell = row.insertCell();
        var setCell = row.insertCell();
        number.innerHTML = i+1;
        playerCell.innerHTML = list[i][0];
        scoreCell.innerHTML = list[i][1];
        setCell.innerHTML = list[i][2];
    }

};

function endGame(){
    writeScore();
    document.getElementById("endgame").style.display = "none";
    document.getElementById("popup-endgame").style.display = "none";
    var table = document.getElementsByTagName("table")[0];
    var tds = table.getElementsByTagName("td");

    for(var i = 0; i < tds.length; i++) {
        tds[i].classList.remove("hit", "miss", "special-hit");
    }
    model.ships = [];
    model.generateShipLocations();
    model.generateSpecialShipLocation();
    model.accumulatedScores = [0, 0];
    model.sets = [0, 0];
    document.getElementById("messageArea1").innerHTML = "";
    document.getElementById("messageArea2").innerHTML = "";
    document.getElementById("turns").innerHTML = "";
    document.getElementById("scorep1").innerHTML = "Scores: 0";
    document.getElementById("scorep2").innerHTML = "Scores: 0";
    document.getElementById("setp1").innerHTML = "0";
    document.getElementById("setp2").innerHTML = "0";
    document.getElementById("winner").innerHTML = "";
};

function closeHofButton(){
    var table = document.getElementById("hall-of-fame");
    var n = table.rows.length
    for (let i = 0; i < n-1; i++){
        var row = table.rows[1];
        table.deleteRow(row.rowIndex);
    }
    document.getElementById("hof").style.display = "none";
    document.getElementById("popup-hof").style.display = "none";
};

window.onload = init; //we want the browser to run init when the page is fully loaded.

var model = {
    player1: "Player 1",
    player2: "Player 2",
    boardSize: 7,
    numShips: 3,
    shipLength: 3,
    shipsSunk: 0,
    limitSets: 3,
    accumulatedScores: [0, 0],
    sets: [0, 0],
    scores: [0, 0], 
    ships: [],
    fire: function(guess, player) {
        for (var i = 0; i < this.numShips; i++) {
            var ship = this.ships[i];
            locations = ship.locations;
            var index = locations.indexOf(guess);
            if(index >= 0){
                if(ship.hits[index] !== "hit"){
                    ship.hits[index] = "hit";
                    if(ship.hits.length == 1){
                        view.displaySpecialHit(guess);
                    }else{
                        view.displayHit(guess);
                    }
                    
                    if (player === 1){
                        view.displayMessage1(this.player1 + " HITS!");
                    } else if(player === 2){
                        view.displayMessage2(this.player2 + " HITS!");
                    }
                    var winner = document.getElementById("winner");
                    var scorep1 = document.getElementById("scorep1");
                    var scorep2 = document.getElementById("scorep2");
                    if (this.isSunk(ship) && player === 1){
                        this.shipsSunk++;
                        this.scores[0]+=10;
                        
                        scorep1.innerHTML = "Scores: " + String(this.scores[0]);
                        if (this.scores[0] > (this.numShips*10 / 2)){
                            this.sets[0]++;
                            var setp1 = document.getElementById("setp1");
                            setp1.innerHTML = this.sets[0];
                            winner.innerHTML = this.player1 + " wins the set!";
                            this.accumulatedScores[0] += this.scores[0];
                            this.accumulatedScores[1] += this.scores[1];
                            this.scores[0] = 0;
                            this.scores[1] = 0;
                            scorep1.innerHTML = "Scores: " + String(this.scores[0]);
                            scorep2.innerHTML = "Scores: " + String(this.scores[1]);
                            if(this.sets[0] > this.limitSets/2){
                                document.getElementById("popup-endgame").style.display = "block";
                                document.getElementById("endgame").style.display = "block";
                                var text = document.getElementById("text-winner");
                                text.innerHTML = this.player1 + " wins the game with the " + String(this.sets[0]) + " scores beat " + this.player2 + " with " + String(this.sets[1]) + " scores!!";
                                
                            } else {
                                var table = document.getElementsByTagName("table")[0];
                                var tds = table.getElementsByTagName("td");

                                for(var i = 0; i < tds.length; i++) {
                                    tds[i].classList.remove("hit", "miss", "special-hit");
                                }
                                this.ships = [];
                                this.generateShipLocations();
                                this.generateSpecialShipLocation();
                            }
                        }
                    } else if (this.isSunk(ship) && player === 2){
                        this.shipsSunk++;
                        this.scores[1]+=10;
                        scorep2.innerHTML = "Scores: " + String(this.scores[1]);
                        if (this.scores[1] > (this.numShips*10 / 2)){
                            this.sets[1]++;
                            var setp2 = document.getElementById("setp2");
                            setp2.innerHTML = this.sets[1];
                            winner.innerHTML = this.player2 + " wins the set!";
                            this.accumulatedScores[0] += this.scores[0];
                            this.accumulatedScores[1] += this.scores[1];
                            this.scores[0] = 0;
                            this.scores[1] = 0;
                            scorep1.innerHTML = "Scores: " + String(this.scores[0]);
                            scorep2.innerHTML = "Scores: " + String(this.scores[1]);
                            if(this.sets[1] > this.limitSets/2){
                                document.getElementById("popup-endgame").style.display = "block";
                                document.getElementById("endgame").style.display = "block";
                                var text = document.getElementById("text-winner");
                                text.innerHTML = this.player2 + " wins the game with the " + String(this.sets[1]) + " scores beat " + this.player1 + " with " + String(this.sets[0]) + " scores!!";
                                
                            } else {
                                var table = document.getElementsByTagName("table")[0];
                                var tds = table.getElementsByTagName("td");

                                for(var i = 0; i < tds.length; i++) {
                                    tds[i].classList.remove("hit", "miss", "special-hit");
                                }
                                this.ships = [];
                                this.generateShipLocations();
                                this.generateSpecialShipLocation();
                            }   
                        }
                    }    
                    
                    return true;
                } else {
                    if(player === 1){
                        view.displayMessage1(this.player1 + " hits the location that has been hit");
                        turns = 2;
                        view.displayTurns(this.player2 + " turns!");
                    }
                    else if(player === 2){
                        view.displayMessage2(this.player2 + " hits the location that has been hit");
                        turns = 1;
                        view.displayTurns(this.player1 + " turns!");
                    }
                    return false;
                }
            }
        }
        
        view.displayMiss(guess);
        if (player === 1){
            turns = 2;
            view.displayMessage1(this.player1 + " missed.");
            view.displayTurns(this.player2 + " turn!");
        }
        else if (player === 2){
            turns = 1;
            view.displayMessage2(this.player2 + " missed.");
            view.displayTurns(this.player1 + " turn!");
        }
        
        return false;
    },
    isSunk: function(ship){
        for (var i = 0; i < ship.hits.length; i++){
            if (ship.hits[i] !== "hit"){
                return false;
            }
        }
        return true;
    },
    generateShipLocations: function() {
        for (var i = 0; i < (this.numShips - 1); i++){
            this.ships.push({ locations: [0, 0, 0], hits: ["", "", ""] });
        }
        var locations;
        for (var i = 0; i < (this.numShips-1); i++) {
        do {
        locations = this.generateShip();
        } while (this.collision(locations));
        this.ships[i].locations = locations;
        }
    },
    generateShip: function(){
        var direction = Math.floor(Math.random() * 2);
        var row, col;
        if (direction === 1) {
            row = Math.floor(Math.random() * this.boardSize);
            col = Math.floor(Math.random() * (this.boardSize - this.shipLength));
        } else {
            row = Math.floor(Math.random() * (this.boardSize - this.shipLength));
            col = Math.floor(Math.random() * this.boardSize);
        }
        var newShipLocations = [];
        for (var i = 0; i < this.shipLength; i++) {
            if (direction === 1) {
                newShipLocations.push(row + "" + (col + i));
            } else {
                newShipLocations.push((row + i) + "" + col);
            }
        }
        return newShipLocations;
    },
    generateSpecialShipLocation: function(){
        this.ships.push({ locations: [0], hits: [""] })
        var locations;
        do {
        locations = this.generateSpecialShip();
        } while (this.collision(locations));
        
        this.ships[this.ships.length-1].locations = locations;
    },
    generateSpecialShip: function(){
        var row = Math.floor(Math.random() * this.boardSize);
        var col = Math.floor(Math.random() * this.boardSize);
        var newShipLocations = [];
        newShipLocations.push(row + "" + col);
        return newShipLocations;
    },
    collision: function(locations){
        for (var i = 0; i < this.ships.length; i++) {
            var ship = model.ships[i];
            
            for (var j = 0; j < locations.length; j++) {
                if (ship.locations.indexOf(locations[j]) >= 0) {
                    return true;
                }
            }
        }
        return false;
    }
}

var controller = {
    processGuess: function(guess){
        var location = guess;
        if (location) {
            var hit = model.fire(location, turns);
        }
    }
};

var view = {
    displayMessage1: function(msg) {
        var messageArea = document.getElementById("messageArea1");
        messageArea.innerHTML = msg;
    },
    displayMessage2: function(msg) {
        var messageArea = document.getElementById("messageArea2");
        messageArea.innerHTML = msg;
    },
    displayHit: function(location) {
        var cell = document.getElementById(location);
        cell.setAttribute("class", "hit");
    },
    displayMiss: function(location) {
        var cell = document.getElementById(location);
        cell.setAttribute("class", "miss");
    },
    displaySpecialHit: function(location){
        var cell = document.getElementById(location);
        cell.setAttribute("class", "special-hit");
    },
    displayTurns: function(msg){
        var messageArea = document.getElementById("turns");
        messageArea.innerHTML = msg;
    }
};