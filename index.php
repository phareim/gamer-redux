
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
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
            
            function new_cherry(){
                return{
                    x: ((Math.random()+0.3)*100)+20,
                    y: ((Math.random()+0.3)*100)+20,
                    width: 10,
                    height: 10,
                    color: 
                    "rgb("+(Math.round(Math.random()*255))+
                    ","+(Math.round(Math.random()*255))+
                    ","+(Math.round(Math.random()*255))+
                    ")",
                    speed: Math.random()*200,
                    direction: 
                    {
                        up: Math.random()>0.5?true:false, right:Math.random()>0.5?true:false
                    },
                    
                    tic:function(mod)
                    {           
                        this.direction.right ? this.x += this.speed * mod :this.x -= this.speed * mod; 
                        this.direction.up    ? this.y += this.speed * mod :this.y -= this.speed * mod;
                        return this;   
                    },
                    
                    changeDirection:function()
                    {
                        if( this.x <0 || this.x >= canvas.width-(this.width))
                        {
                            this.direction.right = !this.direction.right;
                        }
                        if(this.y <0 || this.y >= canvas.height-(this.height))
                        {
                            this.direction.up = !this.direction.up;
                        }
                        return this;
                    }
                };
            }
            
            var cherries = [];
            
            
            var i=0;
            while(i <= 700){
                console.log(i);
                cherries[i] = new_cherry() ;
                i++;
            }
            
            var keysDown = {};
            window.addEventListener('keydown', function(e) {
                keysDown[e.keyCode] = true;
            });
            window.addEventListener('keyup', function(e) {
                console.log("moved " + e.keyCode);
                delete keysDown[e.keyCode];
            });
            
            function updateCherry(a_cherry, mod){
                
                a_cherry.changeDirection().tic(mod);
                
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
                cherries.forEach(function(a,b,c){
                    ctx.fillStyle = a.color;
                    ctx.fillRect(a.x,a.y,a.width, a.height);
                });
                
                ctx.fillStyle = mySprite.color;
                ctx.fillRect(mySprite.x, mySprite.y, mySprite.width, mySprite.height);
            }
            
            function run() {
                update((Date.now() - time) / 1000);
               
                cherries.forEach(function(a,b,c){
                    updateCherry(a,(Date.now() - time) / 1000);
                    
                });
                
                
                render();
                time = Date.now();
            }
            
            var time = Date.now();
            setInterval(run, 10);
            
        </script>
    </body>
</html>