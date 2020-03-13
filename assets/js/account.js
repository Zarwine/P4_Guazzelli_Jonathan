class Account
{
    constructor(target,view,article, titre_article){
        this.target = target;
        this.view = view;
        this.article = article;
        this.titre_article = titre_article;


        let view_button = document.getElementsByClassName(view);
        view_button[0].addEventListener('click', this.showAllArticle);
    }
    showAllArticle(article){
        article
        let jf_articles = document.getElementById(account.target);
        console.log(jf_articles)
        if (jf_articles.classList.contains('container_not_visible')){
            jf_articles.classList.replace('container_not_visible', 'container_visible')
        }else {
            jf_articles.classList.replace('container_visible', 'container_not_visible')
        }
    }

}

let account = new Account('account_view_article','view_account', 'article', 'titre_article');
