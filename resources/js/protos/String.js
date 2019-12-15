var charsArray = {
    0: /°|₀|۰|０/gu,
    1: /¹|₁|۱|１/gu,
    2: /²|₂|۲|２/gu,
    3: /³|₃|۳|３/gu,
    4: /⁴|₄|۴|٤|４/gu,
    5: /⁵|₅|۵|٥|５/gu,
    6: /⁶|₆|۶|٦|６/gu,
    7: /⁷|₇|۷|７/gu,
    8: /⁸|₈|۸|８/gu,
    9: /⁹|₉|۹|９/gu,
    '(c)': /©/gu,
    A: /Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ā|Ą|Α|Ά|Ἀ|Ἁ|Ἂ|Ἃ|Ἄ|Ἅ|Ἆ|Ἇ|ᾈ|ᾉ|ᾊ|ᾋ|ᾌ|ᾍ|ᾎ|ᾏ|Ᾰ|Ᾱ|Ὰ|Ά|ᾼ|А|Ǻ|Ǎ|Ａ|Ä/gu,
    AE: /Æ|Ǽ/gu,
    B: /Б|Β|ब|Ｂ/gu,
    C: /Ç|Ć|Č|Ĉ|Ċ|Ｃ/gu,
    Ch: /Ч/gu,
    D: /Ď|Ð|Đ|Ɖ|Ɗ|Ƌ|ᴅ|ᴆ|Д|Δ|Ｄ/gu,
    Dj: /Ђ/gu,
    Dz: /Џ/gu,
    E: /É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ę|Ě|Ĕ|Ė|Ε|Έ|Ἐ|Ἑ|Ἒ|Ἓ|Ἔ|Ἕ|Έ|Ὲ|Е|Ё|Э|Є|Ə|Ｅ/gu,
    F: /Ф|Φ|Ｆ/gu,
    G: /Ğ|Ġ|Ģ|Г|Ґ|Γ|Ｇ/gu,
    Gx: /Ĝ/gu,
    H: /Η|Ή|Ħ|Ｈ/gu,
    Hx: /Ĥ/gu,
    I: /Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Į|İ|Ι|Ί|Ϊ|Ἰ|Ἱ|Ἳ|Ἴ|Ἵ|Ἶ|Ἷ|Ῐ|Ῑ|Ὶ|Ί|И|І|Ї|Ǐ|ϒ|Ｉ/gu,
    Ij: /Ĳ/gu,
    J: /Ｊ/gu,
    Jx: /Ĵ/gu,
    K: /К|Κ|Ｋ/gu,
    Kh: /Х/gu,
    L: /Ĺ|Ł|Л|Λ|Ļ|Ľ|Ŀ|ल|Ｌ/gu,
    Lj: /Љ/gu,
    M: /М|Μ|Ｍ/gu,
    N: /Ń|Ñ|Ň|Ņ|Ŋ|Н|Ν|Ｎ/gu,
    Nj: /Њ/gu,
    O: /Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ø|Ō|Ő|Ŏ|Ο|Ό|Ὀ|Ὁ|Ὂ|Ὃ|Ὄ|Ὅ|Ὸ|Ό|О|Ө|Ǒ|Ǿ|Ｏ|Ö/gu,
    Oe: /Œ/gu,
    P: /П|Π|Ｐ/gu,
    Ps: /Ψ/gu,
    Q: /Ｑ/gu,
    R: /Ř|Ŕ|Р|Ρ|Ŗ|Ｒ/gu,
    S: /Ş|Ŝ|Ș|Š|Ś|С|Σ|Ｓ/gu,
    Sh: /Ш/gu,
    Shch: /Щ/gu,
    Ss: /ẞ/gu,
    T: /Ť|Ţ|Ŧ|Ț|Т|Τ|Ｔ/gu,
    Th: /Þ|Θ/gu,
    Ts: /Ц/gu,
    U: /Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ů|Ű|Ŭ|Ų|У|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ｕ|Ў|Ü/gu,
    V: /В|Ｖ/gu,
    W: /Ω|Ώ|Ŵ|Ｗ/gu,
    X: /Χ|Ξ|Ｘ/gu,
    Y: /Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ῠ|Ῡ|Ὺ|Ύ|Ы|Й|Υ|Ϋ|Ŷ|Ｙ/gu,
    Ya: /Я/gu,
    Yu: /Ю/gu,
    Z: /Ź|Ž|Ż|З|Ζ|Ｚ/gu,
    Zh: /Ж/gu,
    a: /à|á|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|ā|ą|å|α|ά|ἀ|ἁ|ἂ|ἃ|ἄ|ἅ|ἆ|ἇ|ᾀ|ᾁ|ᾂ|ᾃ|ᾄ|ᾅ|ᾆ|ᾇ|ὰ|ά|ᾰ|ᾱ|ᾲ|ᾳ|ᾴ|ᾶ|ᾷ|а|أ|အ|ာ|ါ|ǻ|ǎ|ª|ა|अ|ا|ａ|ä/gu,
    aa: /ع|आ|آ/gu,
    ae: /æ|ǽ/gu,
    ai: /ऐ/gu,
    b: /б|β|ب|ဗ|ბ|ｂ/gu,
    c: /ç|ć|č|ĉ|ċ|ｃ/gu,
    ch: /ч|ჩ|ჭ|چ/gu,
    d: /ď|ð|đ|ƌ|ȡ|ɖ|ɗ|ᵭ|ᶁ|ᶑ|д|δ|د|ض|ဍ|ဒ|დ|ｄ/gu,
    dj: /ђ|đ/gu,
    dz: /џ|ძ/gu,
    e: /é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ę|ě|ĕ|ė|ε|έ|ἐ|ἑ|ἒ|ἓ|ἔ|ἕ|ὲ|έ|е|ё|э|є|ə|ဧ|ေ|ဲ|ე|ए|إ|ئ|ｅ/gu,
    ei: /ऍ/gu,
    f: /ф|φ|ف|ƒ|ფ|ｆ/gu,
    g: /ĝ|ğ|ġ|ģ|г|ґ|γ|ဂ|გ|گ|ｇ/gu,
    gh: /غ|ღ/gu,
    h: /ĥ|ħ|η|ή|ح|ه|ဟ|ှ|ჰ|ｈ/gu,
    i: /í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|į|ı|ι|ί|ϊ|ΐ|ἰ|ἱ|ἲ|ἳ|ἴ|ἵ|ἶ|ἷ|ὶ|ί|ῐ|ῑ|ῒ|ΐ|ῖ|ῗ|і|ї|и|ဣ|ိ|ီ|ည်|ǐ|ი|इ|ی|ｉ/gu,
    ii: /ई/gu,
    ij: /ĳ/gu,
    j: /ĵ|ј|Ј|ჯ|ج|ｊ/gu,
    k: /ķ|ĸ|к|κ|Ķ|ق|ك|က|კ|ქ|ک|ｋ/gu,
    kh: /х|خ|ხ/gu,
    l: /ł|ľ|ĺ|ļ|ŀ|л|λ|ل|လ|ლ|ｌ/gu,
    lj: /љ/gu,
    m: /м|μ|م|မ|მ|ｍ/gu,
    n: /ñ|ń|ň|ņ|ŉ|ŋ|ν|н|ن|န|ნ|ｎ/gu,
    nj: /њ/gu,
    o: /ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ø|ō|ő|ŏ|ο|ὀ|ὁ|ὂ|ὃ|ὄ|ὅ|ὸ|ό|о|و|ို|ǒ|ǿ|º|ო|ओ|ｏ|ö/gu,
    oe: /ö|œ|ؤ/gu,
    oi: /ऑ/gu,
    oii: /ऒ/gu,
    p: /п|π|ပ|პ|پ|ｐ/gu,
    ps: /ψ/gu,
    q: /ყ|ｑ/gu,
    r: /ŕ|ř|ŗ|р|ρ|ر|რ|ｒ/gu,
    s: /ś|š|ş|с|σ|ș|ς|س|ص|စ|ſ|ს|ｓ/gu,
    sh: /ш|შ|ش/gu,
    shch: /щ/gu,
    ss: /ß/gu,
    sx: /ŝ/gu,
    t: /ť|ţ|т|τ|ț|ت|ط|ဋ|တ|ŧ|თ|ტ|ｔ/gu,
    th: /þ|ϑ|θ|ث|ذ|ظ/gu,
    ts: /ц|ც|წ/gu,
    u: /ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ů|ű|ŭ|ų|µ|у|ဉ|ု|ူ|ǔ|ǖ|ǘ|ǚ|ǜ|უ|उ|ｕ|ў|ü/gu,
    ue: /ü/gu,
    uu: /ऊ/gu,
    v: /в|ვ|ϐ|ｖ/gu,
    w: /ŵ|ω|ώ|ဝ|ွ|ｗ/gu,
    x: /χ|ξ|ｘ/gu,
    y: /ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ|й|ы|υ|ϋ|ύ|ΰ|ي|ယ|ｙ/gu,
    ya: /я/gu,
    yu: /ю/gu,
    z: /ź|ž|ż|з|ζ|ز|ဇ|ზ|ｚ/gu,
    zh: /ж|ჟ|ژ/gu,
    ' ': /\xC2\xA0|\xE2\x80\x80|\xE2\x80\x81|\xE2\x80\x82|\xE2\x80\x83|\xE2\x80\x84|\xE2\x80\x85|\xE2\x80\x86|\xE2\x80\x87|\xE2\x80\x88|\xE2\x80\x89|\xE2\x80\x8A|\xE2\x80\xAF|\xE2\x81\x9F|\xE3\x80\x80|\xEF\xBE\xA0/gu,
};

let languageSpecificCharsArray = language => {
    languageSpecific = {
        bg: [
            ['х', 'Х', 'щ', 'Щ', 'ъ', 'Ъ', 'ь', 'Ь'],
            ['h', 'H', 'sht', 'SHT', 'a', 'А', 'y', 'Y'],
        ],
        da: [['æ', 'ø', 'å', 'Æ', 'Ø', 'Å'], ['ae', 'oe', 'aa', 'Ae', 'Oe', 'Aa']],
        de: [['ä', 'ö', 'ü', 'Ä', 'Ö', 'Ü'], ['ae', 'oe', 'ue', 'AE', 'OE', 'UE']],
        ro: [
            ['ă', 'â', 'î', 'ș', 'ț', 'Ă', 'Â', 'Î', 'Ș', 'Ț'],
            ['a', 'a', 'i', 's', 't', 'A', 'A', 'I', 'S', 'T'],
        ],
    };

    return languageSpecific[language] || null;
};

String.prototype.quote = function(delimiter) {
    return (this.toString() + '').replace(
        new RegExp('[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\' + (delimiter || '') + '-]', 'g'),
        '\\$&'
    );
};

String.prototype.ascii = function(language = 'en') {
    var value = this;
    var languageSpecific = languageSpecificCharsArray(language);

    if (languageSpecific) {
        value = value.replace(languageSpecific[0], languageSpecific[1]);
    }

    Object.keys(charsArray).map(key => {
        value = value.replace(charsArray[key], key);
    });

    return value.replace(/[^\x20-\x7E]/gu, '');
};

String.prototype.toSlug = function(separator = '-', language = 'en') {
    var title = this.toString();
    title = language ? title.ascii(language) : this;

    // Convert all dashes/underscores into separator
    flip = separator === '-' ? '_' : '-';

    title = title.replace(new RegExp('[' + flip.quote() + ']+', 'ug'), separator);

    // Replace @ with the word 'at'
    title = title.replace('@', separator + 'at'.separator);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    title = title
        .toLowerCase()
        .replace(new RegExp('[^' + separator.quote() + '\\p{L}\\p{N}\\s]+', 'ug'), '');

    // Replace all separator characters and whitespace by a single separator
    title = title.replace(new RegExp('[' + separator.quote() + '\\s]+', 'ug'), separator);

    return title.trim(separator);
};
