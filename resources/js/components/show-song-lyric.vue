<template>
    <div id="lyric">
        <ul>
            <li>Lời Bài Hát</li>
            <li v-for="row_content in _rows">
                {{ row_content }}
            </li>
            <li id="lr-more" v-if="showViewMore" @click="onClickViewMore" :class="bindClassMoreBtn">
                {{ viewMoreText }}
            </li>
        </ul>
    </div>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            isOpening: false,
            rows: 0,
            NUM_ROW_DISPLAY: 9,
        };
    },
    props: {
        lyric: String,
    },

    methods: {
        onClickViewMore() {
            if ((this.isOpening = !this.isOpening)) this.NUM_ROW_DISPLAY = this.lyricRows.length;
            else this.NUM_ROW_DISPLAY = 9;
        },
    },

    computed: {
        bindClassMoreBtn: function() {
            return { expand: !this.isOpening, collapse: this.isOpening };
        },

        viewMoreText: function() {
            return this.isOpening ? 'CLOSE' : 'MORE';
        },

        showViewMore: function() {
            return this.lyricRows.length >= this.NUM_ROW_DISPLAY;
        },

        _rows: function() {
            return this.lyricRows.slice(0, this.NUM_ROW_DISPLAY);
        },

        lyricRows: function() {
            return this.lyric ? this.lyric.split(/\r|\n|\t/) : ['Đang Cập Nhật'];
        },
    },
};
</script>
