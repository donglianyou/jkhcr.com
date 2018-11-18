function cleanallstyle() {
				for (i=0;i<4;i++) {
					document.getElementById("focus_"+i).className = "" ;
				}
			}
			function show_focus_image(index) {
				clearTimeout(refreshHotQueryTimer);
				setHotQueryList(index);
				refreshHotQueryTimer = setTimeout('refreshHotQuery();', 3000);
			}
			function setClick() {
				clearTimeout(refreshHotQueryTimer);
			}
		  var refreshHotQueryTimer = null ;
		  var hot_query_td =  document.getElementById('HotSearchList');
		  setHotQueryList(CurrentHotScreen);
		  refreshHotQueryTimer = setTimeout('refreshHotQuery();', 3000);