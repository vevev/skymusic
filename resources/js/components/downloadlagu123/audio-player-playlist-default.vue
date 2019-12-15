<template>
    <div id="playlist-container">
        <audio
            controls
            preload="none"
            :src="audio_src"
            @error="onError"
            v-on:pause="onPause"
            v-on:play="onPlay"
            v-on:ended="onEnded"
            ref="audio"
        >
            Trình duyệt của bạn không hỗ trợ nghe online !
        </audio>
        <div id="songs-container">
            <div v-for="(song, i) in songs" class="song" @click.stop="onCLickMenu(i)">
                <div class="status">
                    <div class="playing icon-play" v-if="!song.play"></div>
                    <div class="pause icon-pause" v-if="song.play"></div>
                </div>
                <div class="info">
                    <h3 class="name">
                        <a :href="song.detail_url" :title="title(song.name)">
                            {{ song.name }}
                        </a>
                    </h3>
                    <span class="sg">
                        <b class="single">{{ song.single }}</b>
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
            index: 0,
            audio_src: null,
            songs: Array,
        };
    },

    props: {
        src: String,
        propSongs: Array,
    },

    methods: {
        title(name) {
            return `Download Mp3 ${name}`;
        },

        onCLickMenu(index) {
            this.index = index;
            this.$refs.audio.src = this.songs[index].detail_url
                .replace('tai-bai-hat-', 'listen/')
                .replace(/\/(.{12})\./, '.$1.');
            this.$refs.audio.load();
            this.$refs.audio.play();
        },

        onPlay() {
            this.$set(this.songs[this.index], 'play', true);
        },

        onPause() {
            this.$set(this.songs[this.index], 'play', false);
        },

        onEnded() {
            if (!this.songs[++this.index]) this.index = 0;
            this.$refs.audio.src = this.songs[this.index].detail_url
                .replace('tai-bai-hat-', 'listen/')
                .replace(/\/(.{12})\./, '.$1.');
            this.$refs.audio.load();
            this.$refs.audio.play();
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
        this.audio_src = this.src;
        this.songs = this.propSongs.slice();
    },
};
</script>
<style type="text/css" lang="scss" scoped>
.song {
    display: block;
    height: 100%;
    padding: 10px 0;
    margin: 0 10px;
    overflow: hidden;
    border: none;
    border-bottom: 1px solid #ededed;
    transition: all 0.5s ease;
    .status {
        height: 40px;
        width: 40px;
        float: left;
        display: flex;
        .pause,
        .playing {
            display: flex;
            flex-grow: 1;
            &:before {
                height: 100%;
                width: 100%;
                justify-content: center;
                align-items: center;
                margin: 0;
                display: flex;
                font-size: 25px;
                color: #888;
            }
        }
        .pause {
        }
        .playing {
        }
    }
    .info {
        display: block;
        padding-bottom: 0;
        border: none;
        h3.name {
            font-size: 15px;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
    &:after {
        content: '';
        display: block;
        clear: both;
    }
}
</style>
