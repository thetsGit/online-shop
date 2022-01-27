<script>
    window.addEventListener("load",()=>{
       $("#loading-show").addClass("d-none");
       $("#loaded-content").removeClass("d-none");
});
 $(()=>{
   const browse = document.getElementById("browse");
   const get = document.getElementById("get");
   const everything = document.getElementById("everything");
   const online = document.getElementById("online");
   const categoryTexts = document.querySelectorAll(".category-text");
   const productCards = document.querySelectorAll(".product-card");

   const options = {
   // root: document.querySelector('#body'),
   rootMargin: '0px',
   threshold: 1.0
   }

   const callback1 = (entries,observer)=>{
       entries.forEach(entry => {
           if(entry.isIntersecting){
               anime({
               targets: entry.target,
               translateY: 0,
               scale: 1,
               opacity: 1,
               duration: 300,
               });
               observer.unobserve(entry.target);
           }
           console.log(entry.target);
       });

   };

   const observer1 = new IntersectionObserver(callback1, options);
   categoryTexts.forEach( (cateText,index,list) => {
       observer1.observe(cateText);
   });

   const callback2 = (entries,observer)=>{
       entries.forEach(entry => {
           if(entry.isIntersecting){
               anime({
               targets: entry.target,
               translateY: 0,
               scale: 1,
               opacity: 1,
               duration: 300,
               });
               observer.unobserve(entry.target);
           }
           console.log(entry.target);
       });

   };

   const observer2 = new IntersectionObserver(callback2, options);
   productCards.forEach( (productCard,index,list) => {
       observer2.observe(productCard);
   })


   browse.innerHTML = browse.innerHTML.split("").map(char => `<span class="jumping-char d-inline-block">${char}</span>`).join("");
   get.innerHTML = get.innerHTML.split("").map(char => `<span class="jumping-char d-inline-block">${char}</span>`).join("");
   everything.innerHTML = everything.innerHTML.split("").map(char => `<span class="jumping-char d-inline-block">${char}</span>`).join("");
   online.innerHTML = online.innerHTML.split("").map(char => `<span class="jumping-char d-inline-block">${char}</span>`).join("");
   anime.timeline({
     easing: "linear",
     delay: 1500
   }).add({
       targets: ".jumping-char",
       translateY: [0,-20,0],
       translateX: [0,20,0],
       scale:[1,2,1],
       delay: anime.stagger(30)
   }).add({
       targets: "#search-box",
       translateY: [30,0],
       opacity: [0,1],
       duration: 500
   },800).add({
       targets: "#supporting-text",
       translateY: [30,0],
       opacity: [0,1],
       duration: 500
   },1000).add({
       targets: ".rotating-agegroup-text",
       rotate: "3turn",
       translateX: [1000,0]
   },1000);
 });
</script>
