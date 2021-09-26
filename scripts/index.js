let data
function getData() {
    $.ajax({
        url: "../src/source.json",
        success: (result) => {
           data = result
           console.log('test')
        }
    })
}

const interval = 1000*60*1;
setInterval(getData(), interval)