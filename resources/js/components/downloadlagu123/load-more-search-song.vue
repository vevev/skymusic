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
        <div
            v-if="page"
            :class="{ loadmore: true, fetching: fetching, error: hasError }"
            @click="onCLickLoadMore"
        ></div>
    </div>
</template>
<script type="text/javascript">
import searchAPI from '../../api/search';
export default {
    data() {
        return {
            songs: [],
            page: 1,
            fetching: 0,
            hasError: false,
        };
    },

    props: {
        query: String,
        api: String,
    },

    watch: {},

    methods: {
        /**
         * Called on c lick load more.
         *
         * @param      {<type>}  event   The event
         */
        onCLickLoadMore(event) {
            if (this.fetching || this.hasError) {
                return;
            }

            ++this.fetching;
            this.fetchResult().then(songs => {
                if (songs.length) {
                    this.songs.push.apply(this.songs, songs);
                } else {
                    this.page = 0;
                }
            });
        },

        /**
         * Fetches a result.
         *
         * @return     {Promise}  The result.
         */
        async fetchResult() {
            try {
                const response = await searchAPI.fetchResult(this.api, {
                    q: this.query,
                    page: ++this.page,
                });

                if (!response.status == 200 || response.data.error) {
                    throw 'Request Error';
                }

                return response.data;
            } catch (e) {
                this.hasError = 1;
            } finally {
                this.fetching = 0;
            }
        },
    },
};
</script>
<style lang="scss" scoped>
.load-more-container {
}
.loadmore {
    display: flex;
    flex-direction: column;
    &:before {
        content: 'Xem Thêm';
        display: flex;
        justify-content: center;
        padding: 10px;
        margin-top: -1px;
        background: #f7f7f7;
        cursor: pointer;
        font-weight: bold;
        height: 20px;
        font-size: 13px;
    }
}
.fetching {
    &:before {
        content: '';
        background: #f7f7f7 url('/svg/search-loadmore-loading-type2.svg');
        background-repeat: no-repeat;
        background-size: 21px 21px;
        background-position: center;
    }
}
.error {
    &:before {
        border-left: 4px solid red;
        height: auto;
        font-size: 12px;
        font-weight: 400;
        font-style: italic;
        line-height: 1;
        cursor: auto;
        justify-content: left;
        content: 'Hmm! Đã xảy ra lỗi không mong muốn. Lỗi này đã được ghi nhận và mình sẽ khắc phục sớm nhất có thể. Mong bạn thông cảm. ^^';
    }
}
</style>
