
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
            
            
            var mySprite = new_cherry();
            mySprite.width = 25;
            mySprite.height = 25;
            mySprite.speed = 150;
            /*{
                x: 100,
                y: 100,
                width: 25,
                height: 25,
                speed: 200,
                color: '#c00'
            };*/
            
            var cherries = [];
            
            var i=0;
            while(i <= 350){
                cherries[i] = new_cherry();
                i++;
            }
            cherries[i] = mySprite;
            
            function new_cherry(){
                return{
                    x: Math.round(((Math.random()*document.getElementsByTagName('body')[0].clientWidth))/6)
                    +document.getElementsByTagName('body')[0].clientWidth/4,
                    y: Math.round(((Math.random()*window.innerHeight)/6))+window.innerHeight/4,
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
                        if( this.x <=0) 
                        {
                            this.direction.right = true;
                        }
                        if(this.x >= canvas.width-(this.width))
                        {
                            this.direction.right = false;
                        }
                        if(this.y <=0)
                        {
                            this.direction.up = true;
                        }
                        if(this.y >= canvas.height-(this.height))
                        {
                            this.direction.up = false;
                        }
                        return this;
                    }
                };
            }
            
            function intersects(block1,block2) {
                block2.width += block2.x;
                block1.width += block1.x;
                if (block2.x > block1.width || block1.x > block2.width) return false;
                block2.height += block2.y;
                block1.heigth += block1.y;
                if (block2.y > block1.heigth || block1.y > block2.heigth) return false;
              return true;
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
                    mySprite.x -= mySprite.speed * mod*1.2;
                    
                }
                if (38 in keysDown && mySprite.y>0) {
                    mySprite.y -= mySprite.speed * mod*1.2;
                    
                }
                if (39 in keysDown && mySprite.x < (canvas.width-(mySprite.width))) {
                    mySprite.x += mySprite.speed * mod*1.2;
                }
                if (40 in keysDown && mySprite.y < (canvas.height-(mySprite.height))) {
                    mySprite.y += mySprite.speed * mod*1.2;
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
                
                cherries.filter(function(c){
                    /*if(c.x <= 0)
                        console.log(c.x+" "+c.y);*/
                });
                
                render();
                time = Date.now();
            }
            
            var time = Date.now();
            setInterval(run, 10);
            
        </script>
    </body>
</html>