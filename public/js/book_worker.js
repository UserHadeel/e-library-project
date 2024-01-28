let lastCategory = "";
let lastLastID = -1;
function getRequests(request) {
    let category = request[0];
    let lastID = request[1];
    let amount = request[2];

    if(category == lastCategory)
        lastID = lastID == -1 ? lastLastID : lastID;
    // in case we intentionalyy want
    // the worker to handle all operations like remembring last id and category...

    fetch('/background-book-worker/'+category+'/'+lastID+'/'+amount).then(v => v.json())
        .then(v => {
            if(v == null) {
                postMessage(['error', 'فشلت عملية طلب الكتب من الخادم']);
            }
            else {
                lastCategory = category;
                lastLastID = v[v.length-1].id; // get the last element's ID
                console.log(lastCategory, lastLastID,v);
            }

        });
}
onmessage = e => {
    let requestType = e.data[0];
    let requestData = e.data[1];

    if(requestType == 'GET')
        getRequests(requestData);
    //postMessage("You sent : "+e.data);
};
