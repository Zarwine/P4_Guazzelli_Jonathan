class Account
{
    constructor(target,view,com_target,com_view,com_target_r,com_view_r){
        this.target = target;
        this.view = view;

        this.com_target = com_target;
        this.com_view = com_view;

        this.com_target_r = com_target_r;
        this.com_view_r = com_view_r;

        let view_button = document.getElementsByClassName(view);
        view_button[0].addEventListener('click', this.showAllArticle);

        let com_view_button = document.getElementsByClassName(com_view);
        com_view_button[0].addEventListener('click', this.showAllComment);

        let com_view_button_r = document.getElementsByClassName(com_view_r);
        com_view_button_r[0].addEventListener('click', this.showAllComment_r);
    }
    showAllArticle(){

        let jf_articles = document.getElementById(account.target);

        if (jf_articles.classList.contains('container_not_visible')){
            jf_articles.classList.replace('container_not_visible', 'container_visible')
        }else {
            jf_articles.classList.replace('container_visible', 'container_not_visible')
        }
    }
    showAllComment(){

        let jf_comments = document.getElementById(account.com_target);
        let jf_comments_r = document.getElementById(account.com_target_r);

        if (jf_comments.classList.contains('container_not_visible')){
            jf_comments.classList.replace('container_not_visible', 'container_visible')
        }else {
            jf_comments.classList.replace('container_visible', 'container_not_visible')
        }

        if (jf_comments_r.classList.contains('container_visible')){
            jf_comments_r.classList.replace('container_visible','container_not_visible')
        }
    }
    showAllComment_r(){

        let jf_comments_r = document.getElementById(account.com_target_r);
        let jf_comments = document.getElementById(account.com_target);

        if (jf_comments_r.classList.contains('container_not_visible')){
            jf_comments_r.classList.replace('container_not_visible', 'container_visible')
        }else {
            jf_comments_r.classList.replace('container_visible', 'container_not_visible')
        }

        if (jf_comments.classList.contains('container_visible')){
            jf_comments.classList.replace('container_visible','container_not_visible')
        }
    }

}

let account = new Account('account_view_article','view_account','account_view_comment','view_comment','account_view_comment_reported','view_comment_reported');

