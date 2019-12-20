<template>
    <div class="download-container">
        <a @click.prevent="onCLick" :href="dataHref" class="download" title="Tải bài hát">
            <b></b>
            &nbsp;Download Mp3&nbsp;
        </a>
        <div class="error-modal-wrapper" v-if="errorDisplay" @click="errorDisplay = false">
            <div class="error-modal">
                <div class="error-modal-head">
                    <b class="icon-cancel-1">Không được tải xuống</b>
                </div>
                <div class="eror-modal-body">
                    Chúng tôi không có bản quyền của bài hát này vì vậy chúng tôi không thể cho bạn
                    tải về. Thật lòng xin lỗi bạn và mong bạn thông cảm !
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            dataHref: '#',
            errorDisplay: false,
        };
    },

    props: {
        href: String,
        download: String,
    },

    methods: {
        onCLick() {
            if (this.download == '1') {
                return (window.location.href = this.href);
            }

            this.dataHref = '#';
            this.errorDisplay = true;
        },
    },

    mounted() {
        this.dataHref = this.href;
    },
};
</script>
<style type="text/css" lang="scss" scoped>
.error-modal-wrapper {
    position: fixed;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: rgba(0, 0, 0, 0.47843137254901963);
    z-index: 9999;
    .error-modal {
        position: fixed;
        min-width: 300px;
        max-width: 1100px;
        border-radius: 3px;
        display: block;
        z-index: 10000;
        top: 30%;
        transition: all 1s ease-in-out;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        box-shadow: 0 0 10px 3px #4a4a4a;
        &:before {
            width: 100%;
            height: 100%;
            content: '';
            background: #ccc;
        }
        .error-modal-head {
            padding: 10px;
            font-size: 15px;
            border-bottom: 1px solid #ccc;
            color: red;
            font-weight: bold;
        }

        .eror-modal-body {
            padding: 10px;
            text-align: justify;
        }
    }
}
</style>
