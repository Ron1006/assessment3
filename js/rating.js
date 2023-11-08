document.getElementById('thumbUp').addEventListener('click', function(){
    var ratingElement= document.getElementById('rating');
    var ratingValue = parseInt(ratingElement.textContent, 10);//获取ratingElement的文档内容，并转化为数字，10代表十进制
    ratingValue += 1;
    ratingElement.textContent = '+' + ratingValue;
})

document.getElementById('thumbDown').addEventListener('click', function(){
    var ratingElement = document.getElementById('rating');
    var ratingValue = parseInt(ratingElement.textContent, 10);
    ratingValue -= 1;
    ratingElement.textContent = (ratingValue >= 0 ? '+' : '') + ratingValue //三元表达式，如果ratingValue >=0, 那么显示'+',如果不是显示'' 
})