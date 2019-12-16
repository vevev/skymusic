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
            <div v-for="(song, i) in songs" :class="{ song: true, songplay: i == index }">
                <div class="status">
                    <div class="playing icon-play" v-if="!song.play"></div>
                    <div class="pause icon-pause" v-if="song.play"></div>
                </div>
                <div class="info">
                    <h3 class="name">
                        <a
                            :href="song.detail_url"
                            :title="title(song.name)"
                            @click.stop.prevent="onCLickMenu(i)"
                        >
                            {{ song.name }}
                        </a>
                    </h3>
                    <span class="sg">
                        <b class="download"><a :href="streamUrl(i)">Tải nhạc</a></b>

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
            index: -1,
            audio_src: null,
            songs: Array,
        };
    },

    props: {
        src: String,
        propSongs: Array,
        playlistid: String,
    },

    methods: {
        title(name) {
            return `Download Mp3 ${name}`;
        },

        onCLickMenu(index) {
            this.index = index;
        },

        onClickDownload(index) {
            console.log(index);
        },

        onPlay() {
            if (this.index === -1) {
                return (this.index = 0);
            }
            this.$set(this.songs[this.index], 'play', true);
        },

        onPause() {
            this.$set(this.songs[this.index], 'play', false);
        },

        onEnded() {
            if (!this.songs[++this.index]) this.index = 0;
            this.$refs.audio.src = this.streamUrl(this.index);
            this.$refs.audio.load();
            this.$refs.audio.play();
        },

        streamUrl(index) {
            return (
                '/listen/' +
                this.songs[index].slug +
                '.' +
                this.songs[index].song_id +
                '.' +
                this.playlistid +
                '.html'
            );
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

    watch: {
        index(n, o) {
            if (n != o) {
                o != -1 && this.$set(this.songs[o], 'play', false);
                this.$refs.audio.src = this.streamUrl(n);
                this.$refs.audio.load();
                this.$refs.audio.play();
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
    display: flex;
    position: relative;
    height: 100%;
    padding: 10px 0;
    margin: 0px;
    overflow: hidden;
    border: none;
    border-bottom: 1px solid #ededed;
    transition: all 0.5s ease;

    .status {
        height: 40px;
        width: 30px;
        display: flex;
        flex-shrink: 0;
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
                font-size: 15px;
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
        min-width: 0;
        flex-grow: 1;
        h3.name {
            font-size: 15px;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sg {
            display: flex;
            margin-top: 5px;
            b {
                display: flex;
                align-items: center;
                padding: 0px 5px;
                a {
                    display: flex;
                    align-items: center;
                    font-size: inherit;
                }
            }
            .single {
                display: block !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .download {
                font-size: 12px !important;
                background: #ffffff00;
                margin-right: 10px;
                color: inherit;
                cursor: pointer;
                &:before {
                    content: '\a021';
                    font-family: fonts;
                    padding-right: 5px;
                }
                &:hover {
                    background: #805b00;
                    a {
                        color: #fff;
                    }
                    &:before {
                        color: #fff;
                    }
                }
            }
        }
    }
    &:after {
        content: '';
        display: block;
        clear: both;
    }
    // &:before {
    //     content: '';
    //     display: flex;
    //     position: absolute;
    //     width: 100%;
    //     height: 100%;
    //     top: 0;
    //     left: 0;
    // }
}
.songplay {
    background: #ededed;
    .info {
        .name {
            a {
                color: red;
            }
        }
    }
}
</style>
