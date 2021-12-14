// Get KeyWords
var getKeywordsCloud = document.querySelectorAll('.get-keywords-cloud a');
let keywordArray = [];
for (let i = 0; i < getKeywordsCloud.length; i++) {
    keywordArray.push({
        text: getKeywordsCloud[i].textContent,
        weight: Math.floor(Math.random() * 10) + 1,
        link: decodeURI(getKeywordsCloud[i].href)
    });
}

// Get Colors
var getKeywordsColors = document.querySelectorAll('.get-keywords-cloud-color span');
let ColorArray = [];
for (let i = 0; i < getKeywordsColors.length; i++) {
    ColorArray.push(getKeywordsColors[i].textContent);
}
// Execute
jQuery(document).ready(function($) {

    let keywordsshape = $('.option-keywords-shape').text(),
        keywordsautoresize = $('.option-keywords-autoresize').text(),
        keywordsdelay = $('.option-keywords-delay').text(),
        keywordsfontSizefrom = $('.option-keywords-fontSizefrom').text(),
        keywordsfontSizeto = $('.option-keywords-fontSizeto').text();

    $('.keywords-cloud').jQCloud(keywordArray, {
        shape: keywordsshape,
        autoResize: keywordsautoresize,
        delay: keywordsdelay,
        colors: ColorArray,
        fontSize: {
            from: keywordsfontSizefrom,
            to: keywordsfontSizeto
        }
    });
});
