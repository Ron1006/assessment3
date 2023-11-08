// 定义一个函数用于切换移动导航的显示状态
function toggleMobileNav(display) {
    const mobileNav = document.querySelector('.mobile-nav');
    mobileNav.style.display = display;
}

// 添加点击事件监听器到菜单图标
document.querySelector('.menu-icon').addEventListener('click', function() {
    // 显示移动导航
    toggleMobileNav('flex');
});

// 添加点击事件监听器到关闭按钮
document.querySelector('.close-icon').addEventListener('click', function() {
    // 隐藏移动导航
    toggleMobileNav('none');
});
