<template>
    <audio
        controls
        loop
        preload="none"
        :src="src"
        @error="onError"
        ref="audio"
        @play="onPlay"
        @pause="onPause"
    >
        Trình duyệt của bạn không hỗ trợ nghe online !
    </audio>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            number_request: 0,
            MAX_NUMBER_REQUEST: 2,
            disco: null,
        };
    },

    props: {
        src: String,
    },

    methods: {
        onPlay(e) {
            !this.disco.classList.contains('disco') && this.disco.classList.add('disco');
            this.disco.classList.remove('pause');
        },

        onPause(e) {
            this.disco.classList.add('pause');
        },

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

    created() {
        this.disco = document.getElementById('disco');
        document.addEventListener('playlist-song-play', function(event) {
            console.log(event);
        });
    },
};
</script>
<style type="text/css" lang="scss" scoped></style>
