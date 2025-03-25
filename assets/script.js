var reactions = {
    reaction1: 0,
    reaction2: 0,
    reaction3: 0,
    reaction4: 0
};

var reactionLabels = {
    reaction1: "👍 This is helpful",
    reaction2: "❤️ I love this",
    reaction3: "🔥 This is amazing",
    reaction4: "💡 Very informative"
};

try {
    var savedReactions = localStorage.getItem('thumbs-widget-reactions');
    if (savedReactions) {
        reactions = JSON.parse(savedReactions);
    }
} catch(e) {
    console.log('Could not load saved reactions');
}

function toggleThumbs() {
    closeThumbsPopups();
    document.getElementById('reactions-popup').style.display = 'block';
}

function saveReaction(type) {
    reactions[type]++;
    try {
        localStorage.setItem('thumbs-widget-reactions', JSON.stringify(reactions));
    } catch(e) {
        console.log('Could not save reaction');
    }
    closeThumbsPopups();
    updateStats();
    document.getElementById('stats-popup').style.display = 'block';
}

function closeThumbsPopups() {
    document.getElementById('reactions-popup').style.display = 'none';
    document.getElementById('stats-popup').style.display = 'none';
}

function updateStats() {
    var total = reactions.reaction1 + reactions.reaction2 + reactions.reaction3 + reactions.reaction4;
    var statsContent = document.getElementById('stats-content');
    
    if (total === 0) {
        statsContent.innerHTML = '<p>No reactions yet</p>';
        return;
    }
    
    var html = '<p><strong>Total reactions:</strong> ' + total + '</p>';
    for (var key in reactions) {
        var percent = Math.round((reactions[key] / total) * 100) || 0;
        html += `<div class="stats-item">
                    <div>${reactionLabels[key]}: ${reactions[key]} (${percent}%)</div>
                    <div class="progress-bar"><div class="progress" style="width:${percent}%"></div></div>
                 </div>`;
    }
    statsContent.innerHTML = html;
}

