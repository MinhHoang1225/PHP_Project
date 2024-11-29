function navigateTo(url) {
    const currentPage = window.location.href;
    if (currentPage.includes(url)) {
        console.log("Bạn đang ở trang này rồi, không cần chuyển hướng.");
        return; 
    }
    setTimeout(function() {
        window.location.href = "/PHP_Project/" + url;
    }, 100); 
}

