let dashboard = {
    initialize: function() {
        dashboard.getIp();
        dashboard.getTimestamp();
    },
    getIp: function() {
        dashboard.request('/api/network/ip', '.showIp');
    },
    getTimestamp: function() {
        dashboard.request('/api/system/timestamp', '.showTimestamp');
    },
    request: function(url, cardClass) {
        fetch(url).then(response => response.text()).then(data => {
            document.querySelectorAll(cardClass).forEach(card => {
                card.querySelector('.card-text').innerHTML = data;
            });
        });
    }
};

dashboard.initialize();
