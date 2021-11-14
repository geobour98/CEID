function x = phghB(min_value, max_value)

[y, fs] = audioread('speech.wav');

if min(y) < min_value || max(y) > max_value
    y = normc(y);
    euros = max_value - min_value;
    new = (new * euros) + min_value;
    y = new
end

x = y;
end
