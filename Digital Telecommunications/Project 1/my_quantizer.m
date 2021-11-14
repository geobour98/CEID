function [xq,centers] = my_quantizer(x, N, min_value, max_value)

l = size(x);
l = l(1);

if min(x) < min_value
    for i=1:l
        if x(i) < min_value
            x(i) = min_value;
        end
    end
end
if max(x) > max_value
    for i=1:l
        if x(i) > max_value
            x(i) = max_value;
        end
    end
end

euros = max_value - min_value;
epipeda = 2^N;
bhma = euros/epipeda;

centers = [];
centers(1) = max_value - bhma/2;
for i=2:epipeda
    centers(i) = centers(i-1) - bhma;
end

xq = [];

for i=1:l
    [apostash arxh] = min(abs(centers - x(i)));
    xq(i) = arxh;
end

xq = xq';

end
