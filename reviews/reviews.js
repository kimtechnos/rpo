class Reviews {
    constructor(options = {
        page_id: 1,
        container: document.querySelector(".reviews"),
        php_file_url: "reviews.php"
    }) {
        this.options = Object.assign({
            reviews_per_pagination_page: 5,
            current_pagination_page: 1
        }, options);
        this.fetchReviews();
    }

    fetchReviews() {
        let url = `${this.options.php_file_url}?page_id=${this.options.page_Id}`;
        url += "current_pagination_page" in this.options ? `&current_pagination_page=${this.options.current_pagination_page}` : '';
        url += "reviews_per_pagination_page" in this.options ? `&reviews_per_pagination_page=${this.options.reviews_per_pagination_page}` : '';
        url += "sort_by" in this.options ? `&sort_by=${this.options.sortBy}` : '';

        fetch(url).then(response => response.text()).then(data => {
            this.options.container.innerHTML = data;
            this._eventHandlers();
        });
    }

    get reviewsperpagination() {
        return this.options.reviews_per_pagination_page;
    }
    set reviewsperpagination(value) {
        this.options.reviews_per_pagination_page = value;
    }

    get currentpaginationpage() {
        return this.options.current_pagination_page;
    }
    set currentpaginationpage(value) {
        this.options.current_pagination_page = value;
    }

    get page_Id() {
        return this.options.page_id;
    }
    set page_Id(value) {
        this.options.page_id = value;
    }

    get php_file_url() {
        return this.options.php_file_url;
    }
    set php_file_url(value) {
        this.options.php_file_url = value;
    }

    get container() {
        return this.options.container;
    }
    set container(value) {
        this.options.container = value;
    }

    get sortBy() {
        return this.options.sortBy;
    }
    set sortBy(value) {
        this.options.sortBy = value;
    }

    _eventHandlers() {
        this.options.container.querySelector(".write_review_btn").onclick = event => {
            event.preventDefault();
            this.options.container.querySelector(".write_review").style.display = 'block';
            this.options.container.querySelector(".write_review input[name='name']").focus();
        };

        this.options.container.querySelector(".write_review form").onsubmit = event => {
            event.preventDefault();
            fetch(`${this.options.php_file_url}?page_id=${this.options.page_Id}`, {
                method: 'POST',
                body: new FormData(this.options.container.querySelector(".write_review form"))
            }).then(response => response.text()).then(data => {
                this.options.container.querySelector(".write_review").innerHTML = data;
            });
        };

        this.options.container.querySelector(".sort_by").onchange = event => {
            this.sortBy = event.target.value;
            this.fetchReviews();
        };

        if (this.reviewsperpagination && this.currentpaginationpage) {
            this.options.container.querySelectorAll(".pagination a").forEach(a => {
                a.onclick = event => {
                    event.preventDefault();
                    this.currentpaginationpage = event.target.dataset.pagination_page;
                    this.reviewsperpagination = event.target.dataset.records_per_page;
                    this.fetchReviews();
                };
            });
        }
    }
}
