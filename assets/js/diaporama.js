class Diaporama {
    constructor(chapitre, slider_prev, slider_next, slider_prev_bottom, slider_next_bottom) {

        this.chapitre = document.getElementsByClassName(chapitre);
        this.sliderPrev = document.getElementById(slider_prev);
        this.sliderNext = document.getElementById(slider_next);
        this.sliderPrev_bottom = document.getElementById(slider_prev_bottom);
        this.sliderNext_bottom = document.getElementById(slider_next_bottom);
        this.index = 0
        let chapitresDiapo = this.chapitre
        let bvn_text = document.getElementsByClassName("bienvenue")[0]
        this.bvn_text = bvn_text

        this.sliderNext.addEventListener('click', e => {
            this.slideNext(chapitresDiapo)
            if (this.bvn_text.classList.contains("bienvenue")) {
                this.bvn_text.classList.replace("bienvenue","invisible")
            }

        });
        this.sliderPrev.addEventListener('click', e => {
            this.slidePrev(chapitresDiapo)
            if (this.bvn_text.classList.contains("bienvenue")) {
                this.bvn_text.classList.replace("bienvenue","invisible")
            }

        });

        this.sliderNext_bottom.addEventListener('click', e => {
            this.slideNext(chapitresDiapo)
            if (this.bvn_text.classList.contains("bienvenue")) {
                this.bvn_text.classList.replace("bienvenue","invisible")
            }

        });
        this.sliderPrev_bottom.addEventListener('click', e => {
            this.slidePrev(chapitresDiapo)
            if (this.bvn_text.classList.contains("bienvenue")) {
                this.bvn_text.classList.replace("bienvenue","invisible")
            }

        });

    }

    slideNext(chapitresDiapo) {

        let currentChapitre = chapitresDiapo[this.index]
        let picturesNumber = chapitresDiapo.length - 1

        if (currentChapitre.classList.contains("diapo_visible")) {
            currentChapitre.classList.replace("diapo_visible", "diapo_invisible")
        }

        if (this.index >= picturesNumber) {
            this.index = 0
        }
        else {
            this.index++
        }
        currentChapitre = chapitresDiapo[this.index]
        if (currentChapitre.classList.contains("diapo_invisible")) {
            currentChapitre.classList.replace("diapo_invisible", "diapo_visible")
        }
    }

    slidePrev(chapitresDiapo) {

        let currentChapitre = chapitresDiapo[this.index]
        let picturesNumber = chapitresDiapo.length - 1

        if (currentChapitre.classList.contains("diapo_visible")) {
            currentChapitre.classList.replace("diapo_visible", "diapo_invisible")
        }

        if (this.index <= 0) {
            this.index = picturesNumber
        }
        else {
            this.index--
        }
        currentChapitre = chapitresDiapo[this.index]
        if (currentChapitre.classList.contains("diapo_invisible")) {
            currentChapitre.classList.replace("diapo_invisible", "diapo_visible")
        }
    }
}
let diaporama = new Diaporama('article_content', 'slider_prev', 'slider_next', 'slider_prev_bottom', 'slider_next_bottom');