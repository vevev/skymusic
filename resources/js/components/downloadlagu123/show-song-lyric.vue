<template>
    <div class="info lr">
        <b class="f15">Lời Bài Hát:</b>
        <br />
        <p>
            <i class="lr-line" v-for="row_content in _rows">
                {{ row_content }}
            </i>
        </p>

        <div v-if="isOpening">
            <br />
            <br />
            Bạn có thể nghe, download Mp3 (tải nhạc), tải bài hát
            <b>{{ name }}</b>
            do ca sĩ {{ single }} thể hiện tại TaiNhac123.Com.
        </div>
        <div v-if="showViewMore" @click="onClickViewMore" class="more">{{ viewMoreText }}</div>
    </div>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            isOpening: false,
            rows: 0,
            NUM_ROW_DISPLAY: 5,
        };
    },
    props: {
        lyric: String,
        name: String,
        single: String,
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
            return this.isOpening ? ' Thu gọn' : ' ... Xem thêm ';
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

<style type="text/css" scoped>
.lr-line {
    box-sizing: border-box;
    padding: 3px 0;
    line-height: 19px;
    min-height: 19px;
    vertical-align: middle;
    display: block;
    font-style: normal;
}
p {
    height: auto;
}
</style>
