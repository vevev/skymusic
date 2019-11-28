<template>
    <form
        @click.stop=""
        :class="formBindClass"
        role="search"
        :action="action"
        method="POST"
        ref="form"
    >
        <input type="hidden" name="_token" :value="token" />
        <div class="input-group" id="search-input">
            <input
                @keyup.prevent="onKeyup"
                @focus.prevent="onFocus"
                autocomplete="off"
                type="text"
                ref="input"
                value=""
                class="form-control"
                name="q"
                placeholder="Masukkan nama lagu dan klik cari ..."
            />
            <button type="submit" class="btn search-btn"></button>
            <!-- <button type="button" class="btn cancel-btn"></button> -->
            <ul id="suggest-result" v-if="suggest_keywords.length">
                <li
                    v-for="(query, index) in suggest_keywords"
                    :class="{ active: focus_index === index }"
                >
                    <a :href="suggestLink(query[0])" v-html="highlightKeyword(index)"></a>
                </li>
            </ul>
        </div>
    </form>
</template>
<script type="text/javascript">
require('../protos/String');
export default {
    data() {
        return {
            suggest_keywords: [],
            focus_index: -1,
            token: '',
            loading: false,
        };
    },
    props: {
        query: String,
        action: String,
        suggestRoute: String,
    },
    mounted() {
        this.$refs.input.value = this.query;
        this.token = window.axios.defaults.headers.common['X-CSRF-TOKEN'];
        document.addEventListener('click', this.onClickDocument);
    },

    computed: {
        formBindClass() {
            return { form: true, active_suggest: !!this.suggest_keywords.length };
        },

        /**
         * Computed Input
         *
         * @return     {<type>}  { description_of_the_return_value }
         */
        _input_value() {
            if (this.focus_index === -1) return this.input_text;
            return this.suggest_keywords[this.focus_index];
        },
    },

    methods: {
        /**
         * { function_description }
         *
         * @param      {<type>}  query   The query
         * @return     {string}  { description_of_the_return_value }
         */
        suggestLink(query) {
            return this.suggestRoute + '/' + query;
        },

        /**
         * Called on focus.
         *
         * @param      Object  event   The event
         */
        onFocus(event) {
            //console.log(this.suggest_keywords);
        },

        /**
         * Called on click document.
         *
         * @param      Object  e       { parameter_description }
         */
        onClickDocument(e) {
            this.suggest_keywords = [];
        },

        /**
         * Làm nổi bật các từ khớp trùng khớp trong từ khóa
         *
         * @param      int  index   The index
         * @return     string
         */
        highlightKeyword(index) {
            return this.suggest_keywords[index][0]
                .replace(
                    new RegExp('(' + this.suggest_keywords[index][1].join('|') + ')', 'g'),
                    '<b>$1</b>'
                )
                .replace(/<b><\/b>/g, '');
        },

        /**
         * Called on keyup down arrow.
         *
         * @param      Object  e
         */
        onKeyupDownArrow(e) {
            this.focus_index < this.suggest_keywords.length - 1 ? this.focus_index++ : '';
            this.$refs.input.value = this.suggest_keywords[this.focus_index][0];
        },

        /**
         * Called on keyup up arrow.
         *
         * @param      Object  e
         */
        onKeyupUpArrow(e) {
            if (this.focus_index === -1) this.focus_index = this.suggest_keywords.length - 1;
            else if (this.focus_index > 0) this.focus_index--;
            this.$refs.input.value = this.suggest_keywords[this.focus_index][0];
        },

        /**
         * Called on keyup enter.
         *
         * @param      {<type>}  e       { parameter_description }
         * @return     {<type>}  { description_of_the_return_value }
         */
        onKeyupEnter(e) {
            return this.$refs.form.submit();
        },

        /**
         * Called on keyup.
         *
         * @param      {<type>}   e       { parameter_description }
         * @return     {Promise}  { description_of_the_return_value }
         */
        async onKeyup(e) {
            if (e.keyCode == 40) return this.onKeyupDownArrow(e);
            if (e.keyCode == 38) return this.onKeyupUpArrow(e);
            if (e.keyCode == 13) return this.onKeyupEnter(e);

            const self = this;
            this.focus_index = -1;

            if (this.loading) return;
            this.loading = true;

            const url =
                'https://suggestqueries.google.com/complete/search?q=' +
                this.$refs.input.value +
                '&hl=id&ds=yt&client=youtube-reduced';
            jsonp(url, this.handleSuccess);
        },

        /**
         * { function_description }
         *
         * @param      {<type>}  error     The error
         * @param      {<type>}  response  The response
         */
        handleSuccess(error, response) {
            if (error) return;

            // Chuyển các từ trong từ khóa ban đầu thành mảng
            var words = response[0].split(' ');

            // Ứng với mỗi từ khóa trong danh sách các từ khóa suggest ta sẽ tìm các từ khớp với
            // các từ ở mảng truy vấn ban đầu
            this.suggest_keywords = response[1].map(function(array, index) {
                return [array[0], this.findWordsInKeyword(words, array)];
            }, this);

            this.loading = false;
        },

        /**
         * Tìm các từ xuất hiện trong từ khóa
         *
         * @param      array    words   The words
         * @param      int      index   The index
         * @param      array    array   Danh sách các từ muốn tìm
         */
        findWordsInKeyword(words, array) {
            let wordsFound = [];
            words.map((word, i) => {
                let regex = new RegExp(word, 'g');
                if (regex.exec(array[0]) && wordsFound.indexOf(word) === -1) {
                    wordsFound.push(word);
                }
            });

            return wordsFound;
        },
    },
};
</script>
<style type="text/css" lang="scss" scoped>
form {
    display: block;
    width: 100%;
    div#search-input {
        display: flex;
        width: 100%;
        position: relative;
        input,
        button {
            border: none;
            background: #fff;
            margin: 0;
            padding: 0;
            outline: none;
            padding: 5px 5px;
        }

        input {
            width: 100%;
            padding-right: 50px;
            font-size: 15px;
            background: #ebebeb;
            border-radius: 3px;
        }
        button {
            position: absolute;
            height: 100%;
            right: 0;
            background: transparent;
        }
        .search-btn {
            background: #22a6f7;
            color: #fff;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            &:before {
                content: '\A005';
                font-family: 'fonts';
                width: 25px;
                display: block;
                font-size: 14px;
            }
        }
        .cancel-btn:before {
            content: '\A013';
            font-family: 'fonts';
            width: 25px;
            display: block;
        }

        ul#suggest-result {
            position: absolute;
            z-index: 10;
            top: 30px;
            width: 100%;
            background: #fdfdfd;
            box-shadow: 0px 5px 10px -2px #cecece;
            border: 1px solid #ebebeb;
            border-radius: 3px;
            overflow: hidden;
            padding: 3px 0;
            li {
                padding: 3px 5px;
                a {
                    color: #333;
                    text-decoration: none;
                }
            }
            .active {
                background: #00a0e0;
                a {
                    color: #fff;
                }
            }
        }
    }
}
.active_suggest {
    #search-input {
    }
}
</style>
