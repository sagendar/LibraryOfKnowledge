function changePage(page, id) {
    var url;

    switch (page) {
        case "edit":
            document.location.href = "/posts/edit/" + id;
            break;
        case "remove":
            //ask if kay
            document.location.href = "/posts/remove/" + id;
    }
}