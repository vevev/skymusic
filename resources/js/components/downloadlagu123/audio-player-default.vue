<template>
    <audio controls preload="none" :src="src" @error="onError" ref="audio">
        Trình duyệt của bạn không hỗ trợ nghe online !
    </audio>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            number_request: 0,
            MAX_NUMBER_REQUEST: 2,
        };
    },

    props: {
        src: String,
    },

    methods: {
        async onError() {
            if (this.number_request >= this.MAX_NUMBER_REQUEST) return;
            this.number_request++;
            try {
                const response = await axios.post(this.src, {}, { headers: { ReCache: 1 } });
                this.$refs.audio.load();
                this.$refs.audio.play();
            } catch (e) {
                console.log(e);
            }
        },
    },
};
</script>
<style type="text/css" lang="scss" scoped></style>
