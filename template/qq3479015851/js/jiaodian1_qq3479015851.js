	var CurrentHotScreen = 0 ;
			function setHotQueryList(screen){
				var Vmotion = "forward" ;
				var MaxScreen = 4 ;
				if (screen >= MaxScreen) {
					screen = 0 ;
					Vmotion = "reverse" ;
				}
				cleanallstyle();
				document.getElementById("focus_"+screen).className = "up" ;
			  
			 
			  for (i=0;i<MaxScreen;i++) {
				document.getElementById("switch_"+i).style.display = "none" ;
			  }
			  document.getElementById("switch_"+screen).style.display = "block" ;
			  
				CurrentHotScreen = screen ;
			}
			function refreshHotQuery(){
				refreshHotQueryTimer = null;
				setHotQueryList(CurrentHotScreen+1);
				refreshHotQueryTimer = setTimeout('refreshHotQuery();', 3000);
			}