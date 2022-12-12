$(function() {
    var Accordion = function(el, multiple) {
      this.el = el || {};
      this.multiple = multiple || false;
  
      // Variables privadas
      var links = this.el.find('.link');
      // Evento
      links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
    }
  
    Accordion.prototype.dropdown = function(e) {
      var $el = e.data.el;
        $this = $(this),
        $next = $this.next();
  
      $next.slideToggle();
      $this.parent().toggleClass('open');
  
      if (!e.data.multiple) {
        $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
      };
    } 
  
    var accordion = new Accordion($('#accordion'), false);
  });
let count = 9;
function mottomiru(e,genre_code){
  e.target.disabled = true;
  count += 9;
  const data = {
    genre_code: genre_code,
    count: count
  }
  fetch('php/ItemSelectAjax.php', {
      method: "POST",
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
  })
  .then((response) => {
      if(!response.ok) {
          throw new Error(`HTTP error: ${response.status}`);
      }   
      return response.json()
  })
  .then(res => {
      // やりたい処理
      let check = res.slice(-2); 
      res = res.slice( 0, -2 );
      document.querySelector('.list-container').innerHTML = res;
      console.log(check);
      if(check == 'OK'){
        e.target.style.display = "none";
      }
      e.target.disabled = false;
  })
  .catch(error => {
      console.log(error); // エラー表示
  });
}