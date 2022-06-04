let allGames = document.getElementsByClassName("gamelijstitem");
let filters = document.getElementsByClassName("filter");

for(let i = 0; i < filters.length; i++){
    filters[i].checked = true;
}

// special filter
let specialFilter = document.getElementById("checkbox-special"); 
specialFilter.onchange = function(){ 
    if(specialFilter.checked === true){ 
        for(let i = 0; i <  allGames.length; i++){ 
            if(allGames[i].dataset.category === "special"){
                allGames[i].style.display = "block"; 
            }
        }
    }
    else{ 
        for(let i = 0; i <  allGames.length; i++){
            if(allGames[i].dataset.category === "special"){
                allGames[i].style.display = "none";
            }
        }
    }
}

//classics filter
let classicsFilter = document.getElementById("checkbox-classics");
classicsFilter.onchange = function(){
    if(classicsFilter.checked === true){
        for(let i = 0; i <  allGames.length; i++){
            if(allGames[i].dataset.category === "classics"){
                allGames[i].style.display = "block";
            }
        }
    }
    else{
        for(let i = 0; i <  allGames.length; i++){
            if(allGames[i].dataset.category === "classics"){
                allGames[i].style.display = "none";
            }
        }
    }
}

//puzzle filter
let puzzleFilter = document.getElementById("checkbox-puzzle");
puzzleFilter.onchange = function(){
    if(puzzleFilter.checked === true){
        for(let i = 0; i <  allGames.length; i++){
            if(allGames[i].dataset.category === "puzzle"){
                allGames[i].style.display = "block";
            }
        }
    }
    else{
        for(let i = 0; i <  allGames.length; i++){
            if(allGames[i].dataset.category === "puzzle"){
                allGames[i].style.display = "none";
            }
        }
    }
}