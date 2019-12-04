<template>
    <div class="load-more-container">
        <div class="menu" v-for="song in songs">
            <div class="detail-thumb">
                <a :title="song.name" :href="song.detail_url">
                    <img :alt="song.name" :title="song.name" :src="song.thumbnail" />
                </a>
            </div>
            <div class="detail-info">
                <h3 class="ab ellipsis dli">
                    <a :title="song.name" :href="song.detail_url">
                        {{ song.name }}
                    </a>
                </h3>
                <span class="sg">
                    <b class="single">{{ song.single }}</b>
                    <b class="play-count" v-if="song.listen">{{ song.listen }}</b>
                </span>
            </div>
        </div>
        <div :class="{ 'icon-loading': true, show: loading }" ref="container"></div>
    </div>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            songs: [],
            page: 1,
            loading: 0,
            searching: 0,
            end: 0,
        };
    },

    props: {
        query: String,
        api: String,
    },

    watch: {
        loading(n, o) {
            n && this.fetchResult();
        },
    },

    methods: {
        onScroll(e) {
            console.log(e);
        },

        async fetchResult() {
            if (this.searching || this.end) return;
            try {
                this.searching = 1;
                const result = await axios.post(this.api, { q: this.query, page: this.page++ });

                if (result.data.error === 'NOTHING') {
                    return (this.end = 1);
                } else if (result.data.results.length) {
                    this.songs.push.apply(this.songs, result.data.results);
                }
            } catch (e) {
            } finally {
                this.searching = 0;
                this.loading = 0;
            }
        },
    },

    mounted() {
        const self = this;
        window.addEventListener('scroll', e => {
            if (self.searching || self.end) {
                return;
            }

            const loading_offset =
                this.$refs.container.offsetTop - e.target.scrollingElement.clientHeight;
            if (loading_offset <= e.target.scrollingElement.scrollTop) {
                self.loading = 1;
            } else {
                self.loading = 0;
            }
        });
    },
};
</script>
<style lang="scss" scoped>
.load-more-container {
    padding: 5px 0;
}
.icon-loading {
    display: block;
    position: relative;
    width: 20px;
    height: 20px;
    border: 3px solid #d2d2d2;
    border-radius: 20px;
    margin: auto;
    -webkit-animation: rotating 0.5s linear infinite;
    -moz-animation: rotating 0.5s linear infinite;
    -ms-animation: rotating 0.5s linear infinite;
    -o-animation: rotating 0.5s linear infinite;
    animation: rotating 0.5s linear infinite;
    opacity: 0;
    transition: all 0.5s ease-in-out;
    &:before {
        position: absolute;
        width: 20px;
        height: 20px;
        border: 3px solid transparent;
        border-left: 3px solid #6d6d6d;
        border-radius: 20px;
        margin: 5px auto;
        content: '';
        box-sizing: border-box;
        top: -8px;
        left: -3px;
    }
}
.show {
    opacity: 1;
}
@-webkit-keyframes rotating /* Safari and Chrome */ {
    from {
        -webkit-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@keyframes rotating {
    from {
        -ms-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -ms-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
.rotating {
    -webkit-animation: rotating 2s linear infinite;
    -moz-animation: rotating 2s linear infinite;
    -ms-animation: rotating 2s linear infinite;
    -o-animation: rotating 2s linear infinite;
    animation: rotating 2s linear infinite;
}
</style>
