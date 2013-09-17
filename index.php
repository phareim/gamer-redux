
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Chase the light</title>
</head>
<body>
	<canvas id="canvas"></canvas>
	
	<script type="text/javascript">
		var canvas = document.getElementById('canvas');
		var ctx = canvas.getContext('2d');
		 
		canvas.width = 400;
		canvas.height = 600;

		var mySprite = {
			x: 200,
			y: 200,
			width: 25,
			height: 25,
			speed: 200,
			color: '#c00'
		};

        var cherry = {
            x: 30,
            y: 40,
            width: 10,
            height: 10,
            color: '#fff',
			speed: 60,
			direction: {up: false,
			            right:false}
        }
        
        var cherries = [cherry];

		var keysDown = {};
		window.addEventListener('keydown', function(e) {
            keysDown[e.keyCode] = true;
		});
		window.addEventListener('keyup', function(e) {
		    console.log("moved " + e.keyCode);
			delete keysDown[e.keyCode];
		});

        function updateCherry(){
           if(cherry.direction.right){
               cherry.x ++;
           }else{
               cherry.x --;
           }
           if(cherry.x <0 || cherry.x > canvas.width-(cherry.width)){
               cherry.direction.right = !cherry.direction.right;
           }
           if(cherry.direction.up){
               cherry.y --;
           }else {
               cherry.y ++;
           }
           if(cherry.y <0 || cherry.y > canvas.height-(cherry.height)){
               cherry.direction.up = !cherry.direction.up;
           }
        }

		function update(mod) {
			if (37 in keysDown) {
			    if(mySprite.x>0){
				    mySprite.x -= mySprite.speed * mod;
			    }
			}
			if (38 in keysDown) {
			    if(mySprite.y>0){
				    mySprite.y -= mySprite.speed * mod;
			    }
			}
			if (39 in keysDown) {
			    if(mySprite.x < (canvas.width-(mySprite.width)))
				    mySprite.x += mySprite.speed * mod;
			}
			if (40 in keysDown) {
			    if(mySprite.y < (canvas.height-(mySprite.height)))
				    mySprite.y += mySprite.speed * mod;
			}
		}
		
		function render() {
			ctx.fillStyle = '#666';
			ctx.fillRect(0, 0, canvas.width, canvas.height);
			
			ctx.fillStyle = cherry.color;
			ctx.fillRect(cherry.x,cherry.y,cherry.width, cherry.height);
			ctx.fillStyle = mySprite.color;
			ctx.fillRect(mySprite.x, mySprite.y, mySprite.width, mySprite.height);
		}

		function run() {
			update((Date.now() - time) / 1000);
			updateCherry();
			
			render();
			time = Date.now();
		}

		var time = Date.now();
		setInterval(run, 10);

	</script>
</body>
</html>