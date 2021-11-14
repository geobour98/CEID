function pith = pithanothta(x)

l = size(x);
p = x;
count = 0;
for i=1:l
    if p(i)<0 || p(i)>4
        count = count + 1;
    end
end

fprintf('Pithanothta: %1.3f%%\n', count/100);
end
