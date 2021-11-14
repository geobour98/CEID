function [val,col_idx,row_blk] = sp_mx2bcrs(A,nb)

[m,n] = size(A);
if m~=n; error('Oi diastaseis tou mhtrwou den einai idies!'); end

val = [];
col_idx = [];
row_blk = [];

counter = 1:m/nb;
cnt = 0;
step = nb;

for i=1:step:m 
    i1 = 0;
    flag = 1;
    for j=1:step:n
        i1 = i1+1;    
        blk = A(i:i+step-1,j:j+step-1);
        if nnz(blk) >= 1
            val = [val blk]; 
            col_idx = [col_idx counter(i1)];            
            cnt = cnt+1;
            if flag == 1
                row_blk = [row_blk cnt];
            end
            flag = 0;
        end
    end
end
row_blk = [row_blk cnt+1];

end
