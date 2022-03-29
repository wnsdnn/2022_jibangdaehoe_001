const $ = ($e,$p=document) => $p.querySelector($e);
const $All = ($e,$p=document) => [...$p.querySelectorAll($e)];
const isClass = ($e,c) => $e.classList.contains(c);
const addClass = ($e,c) => $e.classList.add(c);
const removeClass = ($e,c) => $e.classList.remove(c);
const addEvent = ($e,func,handle='click') => $e.addEventListener(handle,func);
const addEventAll = ($es,func,handle='click') => $es.forEach( $e =>addEvent($e,func,handle) );
const oo = (a) => a.sort(() => Math.random() - 0.5);

const example = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16];
const $cardContainer = $('.card-container');
const $start = $('.start');
const $restart = $('.restart');
const $hint = $('.hint');
let preview = false;
let ing = false;
let focus;

function init(){
   addEvent($start,gameStart);
   addEvent($restart,gameReStart);
   addEvent($hint,() => gameHint(3));
}
function gameStart(){
   if( preview ) return;
   ing = true;
   removeClass($cardContainer,'gameEnd');
   const cards = getCards();
   paintCard(cards);
   gameHint(5);
   addEventAll($All('.card',$cardContainer),cardHandle);
   setTimeout(gameEnd,10000);
}
function gameReStart(){
   if( preview ) return;
   gameStart();
}
function gameHint(second){
   if( !ing ) return; // 게임 진행 중이 아닐 경우 힌트 누를 시 예외처리
   preview = true;
   $All('.card',$cardContainer).forEach( $card => addClass($card,'active') );
   setTimeout(()=>{ // 5초
      $All('.card',$cardContainer).forEach( $card => removeClass($card,'active') );
      preview = false;
   },second*1000);
}
function gameEnd(){
   ing = false;
   addClass($cardContainer,'gameEnd');
   $All('.card',$cardContainer).forEach( $card => {
      addClass($card,'active');
   })
}

function getCards(){
   const cards = oo([...example]).slice(0,8);
   return oo([...cards,...cards]);
}

function paintCard(cards){
   const getCardHTML = (value) => `
      <div class="card rel" data-name="${value}">
         <div class="front abs">${value}</div>
         <div class="back abs"></div>
      </div>
   `
   $cardContainer.innerHTML = cards.map(getCardHTML).join('');
}
function cardHandle(){
   if( isClass(this,'active') || preview ) return; //  active 존재 시 접근 불가
   addClass(this,'active');
   const before = focus?.dataset?.name;
   const current = this.dataset.name;
   if( !focus ){ // 첫번째 클릭
      focus = this;
      setTimeout(()=>{ // 3초후 뒤집기
         if( isClass(this,'active') ) return;
         removeClass(this,'active')
      },3000);
   }else{ // 두번째 클릭
      if( before === current ){ // 서로 일치 
         addClass(focus,'success');
         addClass(this,'success');
         focus = null;
      }else{ // 일치하지 않음
         preview = true;
         setTimeout(()=>{
            removeClass(focus,'active');
            removeClass(this,'active');
            focus = null;
            preview = false;
         },500);
      }
   }
}

/*
   일치 
   비일치 
   본인 X

*/


init();