<template>
    <div id="playlist-container">
        <audio controls loop preload="none" :src="src" @error="onError" ref="audio">
            Trình duyệt của bạn không hỗ trợ nghe online !
        </audio>
        <div id="songs-container">
            <div v-for="song in songs" class="menu">
                <div class="detail-thumb thumb">
                    <a href="{{ $song->detail_url }}" title="Download Mp3 {{ $song->name }}"></a>
                </div>
                <div class="detail-info">
                    <b class="ab ellipsis dli block">
                        <a href="{{ $song->detail_url }}" title="Download Mp3 {{ $song->name }}">
                            {{ $song->name }}
                        </a>
                    </b>
                    <span class="sg">
                        <b class="single">{{ $song->single }}</b>
                    </span>
                </div>
            </div>
        </div>
    </div>
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

    created() {
        document.addEventListener('playlist-song-play', function(event) {
            console.log(event);
        });
    },
};
</script>
<style type="text/css" lang="scss" scoped></style>
