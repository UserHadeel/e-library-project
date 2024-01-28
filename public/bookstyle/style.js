// احصل على عنصر الصفحة المنبثقة
var popup = document.getElementById("popup");

// احصل على الزر أو الرابط الذي يفتح الصفحة المنبثقة
var openButton = document.getElementById("open-button");

// قم بإضافة حدث النقر للزر أو الرابط
openButton.addEventListener("click", function() {
  // قم بتغيير قيمة العرض إلى "block" لعرض الصفحة المنبثقة
  popup.style.display = "block";
});
