function [P,rrnz,rerr] = band_stats(mxid,p)

%mat = ssget(mxid);
A = mxid;
[m,n] = size(A);

if (m < n)
    low = m;
elseif (m > n)
    low = n;
else
    low = m;
    

for i=1:3:low
    B = zeros(m,n)+diag(diag(A));
    for j=1:i
        B = B+diag(diag(A,j),j)+diag(diag(A,-j),-j);
    end
    p = p+1;
    
    rrnz(p,1) = nnz(B)/nnz(A);
    rerr(p,1) = norm(A-B,'fro')/norm(A,'fro');
end
P = [rrnz rerr];
 
end
