
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>Chase the light</title>
</head>
<body>
	<canvas id="canvas">
    </canvas>
	
	<script type="text/javascript">
		var canvas = document.getElementById('canvas');
		var ctx = canvas.getContext('2d');
		var counter = document.getElementById('counter');
		canvas.width = document.getElementsByTagName('body')[0].clientWidth-10;
		canvas.height =  window.innerHeight-20;

		var mySprite = {
			x: 100,
			y: 100,
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
			speed: 150,
			direction: 
            {
                up: false, right:false
            },
            
            tic:function(mod)
            {           
               this.direction.right ? this.x += this.speed * mod :this.x -= this.speed * mod; 
               this.direction.up    ? this.y += this.speed * mod :this.y -= this.speed * mod;
               return this;   
            },
            
            changeDirection:function()
            {
               if( this.x <0 || this.x > canvas.width-(this.width))
               {
                   this.direction.right = !this.direction.right;
               }
               if(this.y <0 || this.y > canvas.height-(this.height))
               {
                   this.direction.up = !this.direction.up;
               }
                return this;
           }
        }
        var cherries = [1,2,3,4,5,6,7,8,9,10];
        
        var keysDown = {};
		window.addEventListener('keydown', function(e) {
            keysDown[e.keyCode] = true;
		});
		window.addEventListener('keyup', function(e) {
		    console.log("moved " + e.keyCode);
			delete keysDown[e.keyCode];
		});

        function updateCherry(a_cherry, mod){
            
                a_cherry.tic(mod).changeDirection();
            
        }

		function update(mod) {
			if (37 in keysDown && mySprite.x>0) {
			   mySprite.x -= mySprite.speed * mod;
			    
			}
			if (38 in keysDown && mySprite.y>0) {
			   mySprite.y -= mySprite.speed * mod;
			    
			}
			if (39 in keysDown && mySprite.x < (canvas.width-(mySprite.width))) {
			   mySprite.x += mySprite.speed * mod;
			}
			if (40 in keysDown && mySprite.y < (canvas.height-(mySprite.height))) {
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
            
        	updateCherry(cherry,(Date.now() - time) / 1000);

            
            cherries.forEach(function(a,b,c){
                
            });
            

			render();
			time = Date.now();
		}

		var time = Date.now();
		setInterval(run, 10);

	</script>
</body>
</html>