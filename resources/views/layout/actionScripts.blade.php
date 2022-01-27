<script>

const favouriteBtns = document.querySelectorAll(".favouriteBtn");
const likeBtns = document.querySelectorAll(".likeBtn");

favouriteBtns.forEach(favouriteBtn => {

favouriteBtn.addEventListener("click",async(e)=>{
console.log(e.target);
const formData = new FormData();
formData.append("product",e.target.dataset.productId);
const spinner = e.target.children[0];
spinner.classList.remove("d-none");
const starIcon = e.target.querySelector("i");
starIcon.classList.add("d-none");
const {data}= await axios.post("{{url("/toggleFavourite")}}",formData);
spinner.classList.add("d-none");
if(data.success === "removed"){
    starIcon.classList = "far fa-star";
}else if(data.success === "added"){
    starIcon.classList = "fas fa-star";
}
else{
    new Noty({
    type: "error",
    layout: "centerRight",
    text     : data.error,
    timeout: 3000,
    killer: true,
    }).show();
    return;
}
new Noty({
type: "info",
layout: "centerRight",
text     : data.success === "removed"? "removed from favourites":"added to favourites",
timeout: 3000,
killer: true,
}).show();

});

});

likeBtns.forEach(likeBtn => {
likeBtn.addEventListener("click",async(e)=>{
const formData = new FormData();
formData.append("product",e.target.dataset.productId);
const spinner = e.target.children[0];
spinner.classList.remove("d-none");
const likeIcon = e.target.querySelector("i");
likeIcon.classList.add("d-none");
const {data}= await axios.post("{{url("/toggleLike")}}",formData);
spinner.classList.add("d-none");
const likeIndicator = e.target.nextElementSibling;
const likeCount = Number(likeIndicator.innerHTML);
if(data.success === "unliked"){
likeIcon.classList = "far fa-heart";
likeIndicator.innerHTML = String(likeCount-1);
}else if(data.success === "liked"){
likeIcon.classList = "fas fa-heart";
likeIndicator.innerHTML = String(likeCount+1);
}
else{
new Noty({
type: "error",
layout: "centerRight",
text     : data.error,
timeout: 3000,
killer: true,
}).show();
return;
}
new Noty({
type: "info",
layout: "centerRight",
text     : data.success,
timeout: 3000,
killer: true,
}).show();

});
});
</script>
