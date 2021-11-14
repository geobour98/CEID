function R = sqnrA(xq, centers, x, e)
if e == 0
    j = 4;
else e == 1
    j = 6;
end
new = centers(xq);
new = new';

S = mean(x.^2);
N = mean((new-x).^2);
R = 10 * log10(S/N);

fprintf('To sqnr gia %d bits einai: %3.3f dBs\n', j ,R);
end
