
window.Promise = Promise;

// Creates a new promise that automatically resolves after some timeout:
window.Promise.delay = function (time) {
    return new Promise(resolve => { setTimeout(resolve, time) });
}

// Throttle this promise to resolve no faster than the specified time:
window.Promise.prototype.takeAtLeast = function (time) {
    return new Promise((resolve, reject) => {

        // Catch error so the promise doesnt end prematurely
        let cPromise        = this.catch(e => e);

        let shoulBeRejected = function(response, resolve, reject) {
            if (response instanceof Error) {
                reject(response);
            } else {
                resolve(response);
            }
        }

        Promise.all([cPromise, Promise.delay(time)])
            .then(
                result => { shoulBeRejected(result.shift(), resolve, reject); },
                error  => { reject(error); }
            );
    });
}