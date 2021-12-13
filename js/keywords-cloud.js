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
jQuery(document).ready(function($) {
    $('.keywords-cloud').jQCloud(keywordArray, {
        shape: 'rectangular',
        colors: ColorArray,
        fontSize: {
            from: 0.1,
            to: 0.02
        }
    });
});